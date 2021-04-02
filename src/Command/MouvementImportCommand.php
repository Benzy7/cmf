<?php

namespace App\Command;

use App\Entity\Mouvement;

use App\Entity\Operation;
use App\Entity\CodeNature;
use App\Entity\CategorieAvoir;
use App\Entity\Adherent;
use App\Entity\Valeur;

use App\Entity\StatMvt;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MouvementImportCommand extends Command
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

    protected static $defaultName = 'mvt:import';
    protected static $defaultDescription = 'insertion de fichiers de mouvement ';

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("en cours d'insérer les données(Mouvement)");
        
        $reader = new Finder();
        $reader->files()->notName('*.sc')->notName('*.er')->in('C:\files\sticodevam\mvt');         

        $io->progressStart(count($reader));

        foreach ($reader as $file){


            $error1 = false; //taille
            $error2 = false; //null

            $erreur = false;
            $first_error1 = false;
            $first_error2 = false;

            $ter = "";
            $ner = "";
            $rm = "";


            $lignes = 0;

            $handle = fopen($file, "r+");

            $nom = $file->getFilename();

            while (($line = fgets($handle)) !== false) {

            $lv = false;
            $lignes++;

            $first3 = substr($line, 0, 3);

            if(!($first3 === "FIN" || $first3 === "DEB")){

                $trim = trim($line);

                if(!(strlen($trim) == 71 )){

                    $erreur = true;
                    $error1 = true;

                    if($first_error1 === false){
                        $ter .= "$lignes"; 
                        $first_error1 = true;
                    }
                    else{
                        $ter .= ", $lignes";
                    }

                    //$io->error("erreur a la ligne $lignes : Fichier mal structuré");
                    //return Command::FAILURE;

                }
                else{

            $codeOp = substr($line, 0, 2);
            $codeOperation = new Operation();
            $codeOperation = $this->container->get('doctrine')->getRepository(Operation::class)->findOneBy(['CodeOperation' => $codeOp]);
            if(!($codeOperation)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Operation) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $isin = substr($line, 2, 12);
            $valeurIsin = substr($line, 5, 10);
            $codeValeur = new Valeur();
            $codeValeur = $this->container->get('doctrine')->getRepository(Valeur::class)
            ->findOneBy(['CodeValeur' => $valeurIsin]);
            if(!($codeValeur)){
                $newValeur = (( new Valeur()))->setCodeValeur($valeurIsin);
                $this->em->persist($newValeur);

                $codeValeur = $newValeur;
            }


            $dateB = substr($line, 14, 8);
            $dateC = substr($line, 22, 8);

            $codeAd = substr($line, 30, 3);
            $codeAdherentLivreur = new Adherent();
            $codeAdherentLivreur = $this->container->get('doctrine')->getRepository(Adherent::class)
            ->findOneBy(['CodeAdherent' => $codeAd]);
            if(!($codeAdherentLivreur)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Adherent livreur) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $ncl = substr($line, 33, 2);
            $codeNatureLivreur = new CodeNature();
            $codeNatureLivreur = $this->container->get('doctrine')->getRepository(CodeNature::class)
            ->findOneBy(['CodeNatureCompte' => $ncl]);
            if(!($codeNatureLivreur)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code nature livreur)$lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $cal = substr($line, 35, 3);
            $catAvLivreur = new CategorieAvoir();
            $catAvLivreur = $this->container->get('doctrine')->getRepository(CategorieAvoir::class)
            ->findOneBy(['CodeCatgorieAvoir' => $cal]);
            if(!($catAvLivreur)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Catégorie Avoir livreur) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $codeAde = substr($line, 38, 3);
            $codeAdherentLivre = new Adherent();
            $codeAdherentLivre = $this->container->get('doctrine')->getRepository(Adherent::class)
            ->findOneBy(['CodeAdherent' => $codeAde]);
            if(!($codeAdherentLivre)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Adherent livré) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $ncle = substr($line, 41, 2);
            $codeNatureLivre = new CodeNature();
            $codeNatureLivre = $this->container->get('doctrine')->getRepository(CodeNature::class)
            ->findOneBy(['CodeNatureCompte' => $ncle]);
            if(!($codeNatureLivre)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Nature livré) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $cale = substr($line, 43, 3);
            $catAvLivre = new CategorieAvoir();
            $catAvLivre = $this->container->get('doctrine')->getRepository(CategorieAvoir::class)
            ->findOneBy(['CodeCatgorieAvoir' => $cale]);
            if(!($catAvLivre)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Catégorie Avoir livré) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $nbTitres = substr($line, 46, 10);
            $montant = substr($line, 56, 15);

            if( $lv === false){
                $mvfile = (new Mouvement())
                    ->setCodeOperation($codeOperation)
                    ->setCodeValeur($codeValeur)

                    ->setStockExchangeDate(\DateTime::createFromFormat('dmY', $dateB))
                    ->setAccounttingDate(\DateTime::createFromFormat('dmY', $dateC))

                    ->setCodeAdherentLivreur($codeAdherentLivreur)
                    ->setNatureCompteLivreur($codeNatureLivreur)
                    ->setCategorieAvoirLivreur($catAvLivreur)

                    ->setCodeAdherentLivre($codeAdherentLivre)
                    ->setNatureCompteLivre($codeNatureLivre)
                    ->setCategorieAvoirLivre($catAvLivre)

                    ->setTitlesNumber($nbTitres)
                    ->setAmount($montant)
                ; 
                
                //if($erreur === false){
                    $this->em->persist($mvfile);
                //    }

                }
            }
            $io->progressAdvance();

        }  
    }
        if($erreur === false){
            $statMv = (new StatMvt())
            ->setNomFicher($nom)
            ->setDateChrg(new \DateTime('now'))
            ->setHeureChrg(new \DateTime('now'))
            ->setDateBourse(\DateTime::createFromFormat('dmY',$dateB))
            ->setEtat("Traité")
            ->setRemarqueMotif("")
            ->setNbLignes($lignes)
        ;
        $this->em->persist($statMv); 

        $f= new Filesystem();
        $newFile = $file.".sc";
        $f->copy($file,$newFile);
        $f->remove($file);

        $this->em->flush();

        }
        else if($erreur === true){

            if($error1 === true){
                $rm .="Erreur(taille) à la lignes : $ter; ";
            }           
            if($error2 === true){
                $rm .= "Erreur(null) à la lignes : $ner; ";
            }
        
        $statMv = (new StatMvt())
            ->setNomFicher($nom)
            ->setDateChrg(new \DateTime('now'))
            ->setHeureChrg(new \DateTime('now'))
            ->setEtat("Erreur")
            ->setRemarqueMotif($rm)
            ->setNbLignes($lignes)
        ; 

        $this->em->persist($statMv);   
            $f= new Filesystem();
            $newFile = $file.".er";
            $f->copy($file,$newFile);
            $f->remove($file)
        ; 

        $this->em->flush();

        }

    }

        $io->progressFinish();
        $io->success('les donné sont inseré avec succés');

        return Command::SUCCESS; 
        
    }
}