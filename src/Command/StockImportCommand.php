<?php

namespace App\Command;

use App\Entity\Stock;

use App\Entity\Operation;
use App\Entity\Valeur;
use App\Entity\CodeNature;
use App\Entity\CategorieAvoir;
use App\Entity\Adherent;

use App\Entity\StatStock;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StockImportCommand extends Command
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

    protected static $defaultName = 'stk:import';
    protected static $defaultDescription = 'insertion de fichiers de stock';

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
        $io->title("en cours d'insérer les données(Stock)");

        $reader = new Finder();
        $reader->files()->notName('*.sc')->notName('*.er')->in('C:\files\sticodevam\stock');            
        
        foreach ($reader as $file){

            $error1 = false; //taille
            $error2 = false; //null

            $erreur = false;
            $first_error1 = false;
            $first_error2 = false;

            $ter = "";
            $ner = "";
            $rm = "";

            $nom = $file->getFilename();

            $lignes = 0;

            $handle = fopen($file, "r+");

            while (($line = fgets($handle)) !== false) {

            $lv = false;
            $lignes++;

            $first3 = substr($line, 0, 3);

            if(!($first3 === "FIN" || $first3 === "DEB")){

                    $trim = trim($line);

                if(!(strlen($trim) == 47 )){
    
                    $erreur = true;
                    $error1 = true;

                    if($first_error1 === false){
                        $ter .= "$lignes"; 
                        $first_error1 = true;
                    }
                    else{
                        $ter .= ", $lignes";
                    }
                }
                else{

            $codeAd= substr($line, 0, 3);
            $codeAdherent = new Adherent();
            $codeAdherent = $this->container->get('doctrine')->getRepository(Adherent::class)
            ->findOneBy(['CodeAdherent' => $codeAd]);
            if(!($codeAdherent)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Adherent) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $isin = substr($line, 3, 12);
            $valeurIsin = substr($line, 5, 10);
            $codeValeur = new Valeur();
            $codeValeur = $this->container->get('doctrine')->getRepository(Valeur::class)
            ->findOneBy(['CodeValeur' => $valeurIsin]);
            if(!($codeValeur)){
                $newValeur = (( new Valeur()))->setCodeValeur($valeurIsin);
                $this->em->persist($newValeur);
                //$this->em->flush();

                $codeValeur = $newValeur;
            }

            $cnc = substr($line, 15, 2);
            $codeNature = new CodeNature();
            $codeNature = $this->container->get('doctrine')->getRepository(CodeNature::class)
            ->findOneBy(['CodeNatureCompte' => $cnc]);
            if(!($codeNature)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Code Nature) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $cca = substr($line, 17, 3);
            $catAv = new CategorieAvoir();
            $catAv = $this->container->get('doctrine')->getRepository(CategorieAvoir::class)
            ->findOneBy(['CodeCatgorieAvoir' => $cca]);
            if(!($catAv)){
                $lv = true;
                $erreur = true;
                $error2 = true;
                if($first_error2 === false){
                    $ner .= "(Catégorie Avoir) $lignes"; 
                    $first_error2 = true;
                }
                else{
                    $ner .= ", $lignes";
                }
            }

            $quantite = substr($line, 20, 10);
            $sens = substr($line, 30, 1);
            $dateB = substr($line, 31, 8);
            $dateC = substr($line, 39, 8);

            if( $lv === false){
                $stkfile = (new Stock())
                    ->setCodeAdherent($codeAdherent)
                    ->setCodeValeur($codeValeur)
                    ->setNatureCompte($codeNature)
                    ->setCategorieAvoir($catAv)
                    ->setQuantity($quantite)
                    ->setMeaning($sens)
                    ->setStockExchangeDate(\DateTime::createFromFormat('dmY', $dateB))
                    ->setAccountingDate(\DateTime::createFromFormat('dmY', $dateC))
                ; 

                $this->em->persist($stkfile);
                }

            }            
          }
        }

        if($erreur === false){
            $statMv = (new StatStock())
            ->setNomFicher($nom)
            ->setDateChrg(new \DateTime('now'))
            ->setHeureChrg(new \DateTime('now'))
            ->setDateBourse(\DateTime::createFromFormat('dmY', $dateB))
            ->setEtat("Traité")
            ->setRemarqueMotif("")
            ->setNbLignes($lignes)
        ;
        $this->em->persist($statMv); 

        $f= new Filesystem();
        $newFile = $file.".sc";
        $f->copy($file,$newFile);
        $f->remove($file);

        }
        else if($erreur === true){
            if($error1 === true){
                $rm .="Erreur(taille) à la lignes : $ter; ";
            }           
            if($error2 === true){
                $rm .= "Erreur(null) à la lignes : $ner; ";
            }

            $statMv = (new StatStock())
            ->setNomFicher($nom)
            ->setDateChrg(new \DateTime('now'))
            ->setHeureChrg(new \DateTime('now'))
            ->setDateBourse(\DateTime::createFromFormat('dmY', $dateB))
            ->setEtat("Erreur")
            ->setRemarqueMotif($rm)
            ->setNbLignes($lignes)
        ; 
        $this->em->persist($statMv);

        
            $f= new Filesystem();
            $newFile = $file.".er";
            $f->copy($file,$newFile);
            $f->remove($file); 

            }

        }

        $this->em->flush();

        $io->success('les donné sont inseré avec succés');

        return Command::SUCCESS;
    }
}