<?php

namespace App\Command;

use App\Entity\Orders;
use App\Entity\OrdTypePrix;
use App\Entity\OrdTypeVld;
use App\Entity\OrdStat;
use App\Entity\AdhrentIntermidiaire;
use App\Entity\Adherent;
use App\Entity\Valeur;

use App\Entity\StatOrd;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class OrdImportCommand extends Command
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

    protected static $defaultName = 'ord:import';
    protected static $defaultDescription = 'insertion de fichiers des orders';

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
        $io->title("en cours d'insérer les données(Orders)");

        $reader = new Finder();
        $reader->files()->notName('*.sc')->notName('*.er')->in('C:\files\orders');         

        $io->progressStart(count($reader));

        $erreur = false;

        foreach ($reader as $file){

            $lignes = 0;

            $handle = fopen($file, "r+");

            $nom = $file->getFilename();
            $dateFicher = substr($nom, strpos($nom, ".") +1);

            while (($line = fgets($handle)) !== false) {

                $lv = false;
                $lignes++;

                $Ord = substr($line, 2, 3);

                if($Ord === "Ord"){

                    

                    $io->progressAdvance();
                }
                else if(!($Ord === "Ord")){

                    $typeEnrg = substr($line, 0, 2);

                    //adr
                    $Cadr = substr($line, 2, 8);
                    $adrC = substr($Cadr, 5, 3);
                    $adr = new Adherent();
                    $adr = $this->container->get('doctrine')->getRepository(Adherent::class)
                    ->findOneBy(['CodeAdherent' => $adrC]); 
                    $adri = new AdhrentIntermidiaire();
                    $adri = $this->container->get('doctrine')->getRepository(AdhrentIntermidiaire::class)
                    ->findOneBy(['CodeInterm' => $adr]);
                    if(!($adri)){
                        $erreur = true;

                        $lv = true;
                    }

                    $filler1 = substr($line, 10, 1);

                    //val
                    $Cval = substr($line, 11, 12);
                    $val = substr($Cval, 5, 6); 
                    $valeur = new Valeur();
                    $valeur = $this->container->get('doctrine')->getRepository(Valeur::class)
                    ->findOneBy(['CodeValeur' => $val]);
                    if(!($valeur)){
                        $erreur = true;

                        $lv = true;
                    }

                    $Dom = substr($line, 23, 8);
                    $DomMod = substr($line, 31, 8);
                    $DomFV = substr($line, 39, 8);
                    $Hom = substr($line, 47, 6);
                    $Hft = substr($line, 53, 6);

                    $IdcGel = substr($line, 59, 1);

                    //stat
                    $stt = substr($line, 60, 1);
                    $stat = new OrdStat();
                    $stat = $this->container->get('doctrine')->getRepository(OrdStat::class)
                    ->findOneBy(['CodeStatOrd' => $stat]);
                    if ($stt == ' '){
                        $stat = $this->container->get('doctrine')->getRepository(OrdStat::class)
                        ->findOneBy(['id' => 1]);
                    }else if(!($stat)){
                        $erreur = true;
                    }
                   
                    $IdcCR = substr($line, 61, 1);

                    $filler2 = substr($line, 62, 1);

                    $sens = substr($line, 63, 1);

                    //type prix
                    $tPrix = substr($line, 64, 1);
                    $TypePrix = new OrdTypePrix();
                    $TypePrix = $this->container->get('doctrine')->getRepository(OrdTypePrix::class)
                    ->findOneBy(['CodeTypePrix' => $tPrix]);
                    if(!($TypePrix)){
                        $erreur = true;

                        $lv = true;
                    }

                    $filler3 = substr($line, 65, 9);

                    $NscO = substr($line, 74, 6);
                    $NscOMod = substr($line, 80, 6);

                    $filler4 = substr($line, 86, 19);

                    $Oprix = substr($line, 105, 19);
                    $Qdev = substr($line, 124, 18);
                    $Qmin = substr($line, 142, 18);
                    $Qneg = substr($line, 160, 18);
                    $Qtot = substr($line, 178, 18);

                    $filler5 = substr($line, 196, 2);

                    $origine = substr($line, 198, 1);

                    //type validite
                    $tVld = substr($line, 199, 1);
                    $TypeVld = new OrdTypeVld();
                    $TypeVld = $this->container->get('doctrine')->getRepository(OrdTypeVld::class)
                    ->findOneBy(['CodeTypeVld' => $tVld]);
                    if(!($TypeVld)){
                        $erreur = true;

                        $lv = true;
                    }

                    $sousHub = substr($line, 200, 11);
                    $tPrixOriginal = substr($line, 211, 1);
                    $prixStopOrdTrg = substr($line, 212, 19);

                    $idTrad = substr($line, 231, 8);
                    $idGiveUp = substr($line, 239, 8);

                    //type compte (a faire)
                    $TypeCompte = substr($line, 247, 1);
                    
                    $NcptCl = substr($line, 248, 16);
                    $TradOrdN = substr($line, 264, 8);

                    $filler6 = substr($line, 272, 5);

                    $DateHeureEO = substr($line, 277, 14);
                    $txtLib = substr($line, 291, 18);
                    $postAct = substr($line, 309, 1);

                    $filler7 = substr($line, 310, 1);

                    $postGiv = substr($line, 311, 1);

                    $filler8 = substr($line, 312, 72);

                    //dd($Hom);
                    //dd(number_format($prixStopOrdTrg));
                    //dd(intval($prixStopOrdTrg));

                    if( $lv === false){
                        $ordl = (new Orders())
                            ->setDateFicher(\DateTime::createFromFormat('Ymd', $dateFicher))
                            ->setTypeEnrg($typeEnrg)
                            ->setCodeValeur($valeur)
                            ->setCodeAdi($adri)
                            ->setDateEntreeOrdre(\DateTime::createFromFormat('Ymd', $Dom))
                            ->setDateFinVldOrdre(\DateTime::createFromFormat('Ymd', $DomFV))
                            ->setHeureEntreeOrdre(\DateTime::createFromFormat('His', $Hom))
                            ->setHeureFinTrtOrdre(\DateTime::createFromFormat('His', $Hft))
                            ->setIndcGel($IdcGel)
                            ->setStatOrd($stat)
                            ->setIndCrossOrd($IdcCR)
                            ->setSensOrd($sens)
                            ->setTypePrixOrd($TypePrix)
                            ->setNscOrd($NscO)
                            ->setNscOrdMod($NscOMod)
                            ->setPrixOrd($Oprix)
                            ->setQteDev($Qdev)
                            ->setQteMin($Qmin)
                            ->setQteNeg($Qneg)
                            ->setQteTot($Qtot)
                            ->setOrgOrd($origine)
                            ->setTypeVldOrd($TypeVld)
                            ->setSusHub($sousHub)
                            ->setTypePrixOrg($tPrixOriginal)
                            ->setPrixStpOrdTrg($prixStopOrdTrg)
                            ->setTradIdn($idTrad)
                            ->setDestIdn($idGiveUp)
                            ->setTypeCpt($TypeCompte)
                            ->setNcptCl($NcptCl)
                            ->setNtradOrd($TradOrdN)
                            ->setDateHeureEntreeOrd(\DateTime::createFromFormat('YmdHis', $DateHeureEO))
                            ->setTxtLibr($txtLib)
                            ->setPostActionOrd($postAct)
                            ->setPostActionGvOrd($postGiv)
                            ->setRefOrd('123test')
                        ; 
                        if(number_format($DomMod) == 0){
                           $ordl->setDateModOrdre(null);
                        }else{
                            $ordl->setDateModOrdre(\DateTime::createFromFormat('Ymd', $DomMod));
                        }
                        
                            $this->em->persist($ordl);
                        }

                }
                $io->progressAdvance();

    
            }
            if($erreur === false){
                $stat = (new StatOrd())
                ->setNomFicher($nom)
                ->setDateChrg(new \DateTime('now'))
                ->setHeureChrg(new \DateTime('now'))
                ->setDateFicher(\DateTime::createFromFormat('dmY',$dateFicher))
                ->setEtat("Traité")
                ->setRemarqueMotif("")
                ->setNbLignes($lignes)
            ;
            $this->em->persist($stat); 
    
            $f= new Filesystem();
            $newFile = $file.".sc";
            $f->copy($file,$newFile);
            $f->remove($file);
    
            $this->em->flush();
    
            }
            else if($erreur === true){
                $this->em->clear();
/*                 if($error1 === true){
                    $rm .="Erreur(taille) à la lignes : $ter; ";
                }           
                if($error2 === true){
                    $rm .= "Erreur(null) à la lignes : $ner; ";
                } */
            
            $stat = (new StatOrd())
                ->setNomFicher($nom)
                ->setDateChrg(new \DateTime('now'))
                ->setHeureChrg(new \DateTime('now'))
                ->setDateFicher(null)
                ->setEtat("Erreur")
                ->setRemarqueMotif("erreur")
                ->setNbLignes($lignes)
            ; 
    
            $this->em->persist($stat);   
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