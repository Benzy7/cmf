<?php

namespace App\Command;

use App\Entity\Tfile;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TxtImportCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected static $defaultName = 'txt:import';
    protected static $defaultDescription = 'Inserer tfile donnée';

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::$defaultDescription)
            //->addArgument('ignoreFirstLine', InputArgument::OPTIONAL, 'ignrer le premier ligne')
            //->addOption('ignoreFirstLine', true, InputOption::VALUE_NONE, 'ignrer le premier ligne')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("en cours d'inserer les données");

        //$reader = Reader::createFromPath( path: 'C:\xampp\htdocs\cmf\src\files\sticodevam\mv');
        
        $reader = new Finder();
        $reader->files()->in('C:\xampp\htdocs\cmf\src\files\sticodevam\mv');            
        
        foreach ($reader as $row){

            //$cursor = new Cursor($output);
            
            //$contents =  $row->getContents();
            $handle = fopen($row, "r");

            while (($line = fgets($handle)) !== false) {
            
            $first3 = substr($line, 0, 3);

/*             if($first3 === "DEB"){

                //$cursor->moveDown();
                $first3 = substr($line, 0, 3);

            } */


            if(!($first3 === "FIN" || $first3 === "DEB")){

            $first5 = substr($line, 0, 5);
            $last11 = substr($line, 5, 14);
            $date = substr($line, 19, 8);
            //$DD = substr($line, 19, 2);
            //$MM = substr($line, 21, 2);
            //$YYYY = substr($line, 23, 4);
            //$dates= '';
            //$dates="$YYYY-$MM-$DD";
            //$dates .=$YYYY;
            //$dates .='-'.$MM.
            //$dates .='-'.$DD.
            //$datef = \DateTime::createFromFormat("d-m-Y", "$dates");

            $file = (new Tfile())
            
                ->setTitle($first5)
                ->setBody($last11)
                ->setDate(\DateTime::createFromFormat('dmY', $date))
                ->setDateT($date)
                //->setDate($datef)
                //->setDate($YYYY-$MM-$DD)
            ;

            $this->em->persist($file);
            
            //$cursor->moveDown();
            //$first3 = substr($line, 0, 3);

            }
        }

        }


/*         $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        } */

        $this->em->flush();

        $io->success('les donné sont inseré avec succés');

        return Command::SUCCESS;
    }
}