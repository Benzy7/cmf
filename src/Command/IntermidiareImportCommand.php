<?php

namespace App\Command;

use App\Entity\Intermidiaire;
use App\Entity\Adherent;
use App\Entity\CodeCompteIntrm;
use App\Entity\CodeMarche;
use App\Entity\CodeProfit;
use App\Entity\ReglementIntrm;
use App\Entity\Valeur;

use App\Entity\StatIntermidiaire;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class IntermidiareImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    private $container;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        parent::__construct();

        $this->container = $container;

        $this->em = $em;
    }

    protected static $defaultName = 'intrm:import';
    protected static $defaultDescription = 'insertion de fichiers intermidiaires';

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $reader = new Finder();
        $reader->files()->notName('*.sc')->notName('*.er')->in('C:\files\intermidiaires'); 

        $io = new SymfonyStyle($input, $output);
        $io->title("en cours d'insérer les données(Intermidiaires)");
        $io->progressStart(count($reader));

        $erreur = false;

        $AdhrentIB = null;

        $lignes = 0;

        $nom = "";
        $dateT = "";

        foreach ($reader as $file){

            $lines = file($file);
            $add_info = "DateTransaction;NumContrat;Sens;Code_Valeur;Libelle_Valeur;Caract;Marche;Profit;Client;Type_Compte;Pays;Quantite;Cours;Code_Intermediaire;Reglement;Commission; \n";
            $lines[0] = $add_info;
            $add_info .= file_get_contents($file);
            file_put_contents($file, $lines);

            $lignes = 1;
            $nom = $file->getFilename();

            $adrIB =  substr($nom, 0, -11);
            $AdhrentIB = new Adherent();
            $AdhrentIB = $this->container->get('doctrine')->getRepository(Adherent::class)->findOneBy(['NomAdherent' => $adrIB]);
            if(!($AdhrentIB)){
                $AdhrentIB = null;
            }

            $erreur = false;
            $ner= "";

            $supplierFiles = $this->getCsvRowsAsArrays($file);

            foreach($supplierFiles as $supplierFile){
            $lignes++;

            $dateT = $supplierFile['DateTransaction'];
    
                $codeValeur = new Valeur();
                $codeValeur = $this->container->get('doctrine')->getRepository(Valeur::class)->findOneBy(['CodeValeur' => $supplierFile['Code_Valeur']]);
                if(!($codeValeur)){
                    $newValeur = (( new Valeur()))
                        ->setCodeValeur($supplierFile['Code_Valeur'])
                        ->setLibelleValeur($supplierFile['Libelle_Valeur'])
                        ->setNbCodFlott($supplierFile['Caract'])
                    ;
                    $this->em->persist($newValeur);
    
                    $codeValeur = $newValeur;    
                }

                $codeMarche = new CodeMarche();
                $codeMarche = $this->container->get('doctrine')->getRepository(CodeMarche::class)->findOneBy(['CodeMarche' => $supplierFile['Marche']]);
                if(!($codeMarche)){
                    $erreur = true;
                    $ner .=" Code Marché($lignes),"; 
                }

                $codeProfit = new CodeProfit();
                $codeProfit = $this->container->get('doctrine')->getRepository(CodeProfit::class)->findOneBy(['CodeProfit' => $supplierFile['Profit']]);
                if(!($codeProfit)){
                    $erreur = true;
                    $ner .=" Code Profit($lignes),"; 
                }

                $codeCompte = new CodeCompteIntrm();
                $codeCompte = $this->container->get('doctrine')->getRepository(CodeCompteIntrm::class)->findOneBy(['CodeCompte' => $supplierFile['Type_Compte']]);
                if(!($codeCompte)){
                    $erreur = true;
                    $ner .=" Code Compte($lignes),"; 
                }
                

                $codeAdr = new Adherent();
                $codeAdr = $this->container->get('doctrine')->getRepository(Adherent::class)->findOneBy(['CodeAdherent' => $supplierFile['Code_Intermediaire']]);
                if(!($codeAdr)){
                    $erreur = true;
                    $ner .=" Code Intermidiaire($lignes),"; 
                }

                if($supplierFile['Sens'] === 'V'){

                    $Reglement = new ReglementIntrm();
                    $Reglement = $this->container->get('doctrine')->getRepository(ReglementIntrm::class)->findOneBy(['CodeReg' => $supplierFile['Reglement']]);
                    if(!($Reglement)){
                        $erreur = true;
                        $ner .="Code Reglement($lignes),"; 

                    }

                }

                if($erreur === false){

                    //dd($supplierFile['DateTransaction']);
                    //dd($supplierFile);

                    $intrmFile = new Intermidiaire();
                    $intrmFile->setDateTransaction(new \DateTime($supplierFile['DateTransaction']));
                    $intrmFile->setContract($supplierFile['NumContrat']);
                    $intrmFile->setSens($supplierFile['Sens']);
                    $intrmFile->setValeur($codeValeur);
                    $intrmFile->setMarche($codeMarche);
                    $intrmFile->setProfit($codeProfit);
                    $intrmFile->setClient($supplierFile['Client']);
                    $intrmFile->setTypeCompte($codeCompte);
                    $intrmFile->setPays($supplierFile['Pays']);
                    $intrmFile->setQuantite($supplierFile['Quantite']);
                    $intrmFile->setCours($supplierFile['Cours']);
                    $intrmFile->setCodeAdrIntrm($codeAdr);
                    $intrmFile->setCommission($supplierFile['Commission']);
                    if($supplierFile['Sens'] === 'V'){
                        $intrmFile->setReglement($Reglement);
                    }


                    $this->em->persist($intrmFile);
                }
    
            }
            $io->progressAdvance();
        
            if($erreur === false){
                //dd($nom);
                //dd($dateT);

            $statSC = (new StatIntermidiaire())
                ->setNomFicher($nom)
                ->setDateTransaction(new \DateTime($supplierFile['DateTransaction']))
                ->setDateChrg(new \DateTime('now'))
                ->setHeureChrg(new \DateTime('now'))
                ->setEtat("Traité")
                ->setRemarqueMotif("")
                ->setNbLignes($lignes)
                ->setNomAdherent($AdhrentIB)
            ;
            $this->em->persist($statSC); 
            $this->em->flush();

        /*     $f= new Filesystem();
            $newFile = $file.".sc";
            $f->copy($file,$newFile);
            $f->remove($file);
         */
            }
            else if($erreur === true){
            
            $rm = "Erreur à la lignes : $ner ; ";
            
            $statER = (new StatIntermidiaire())
                ->setNomFicher($nom)
                ->setDateChrg(new \DateTime('now'))
                ->setHeureChrg(new \DateTime('now'))
                ->setDateTransaction(null)
                ->setEtat("Erreur")
                ->setRemarqueMotif($rm)
                ->setNbLignes($lignes)
            ; 

            $this->em->persist($statER);
            $this->em->flush();
   
/*                 $f= new Filesystem();
                $newFile = $file.".er";
                $f->copy($file,$newFile);
                $f->remove($file);  */

            }
        }

        $io->progressFinish();
        $io->success('les donné sont inseré avec succés');

        return Command::SUCCESS;
    }

    public function getCsvRowsAsArrays($file){
        $inputFile = $file;
        $decoder = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        return $decoder->decode(file_get_contents($inputFile), 'csv', array(CsvEncoder::DELIMITER_KEY => ';'));
    
    }
}
