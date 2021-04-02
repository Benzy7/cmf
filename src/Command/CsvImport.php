<?php

namespace App\Command;

use App\Entity\Tfile;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CsvImport extends Command
{
    protected static $defaultName = 'file:update';

    public function __construct($projectDir, EntityManagerInterface $em)
    {
        $this->projectDir = $projectDir;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('update file')
           //->addArgument('markup', InputArgument::OPTIONAL, 'Percentage markup', 20)
           ->addArgument('process_date', InputArgument::OPTIONAL, 'Date of process', date_create()->format('Ym'))
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    $processDate = $input->getArgument('process_date');
    //$markup = ($input->getArgument('markup') / 100) + 1;
 
    $supplierFiles = $this->getCsvRowsAsArrays($processDate);
    //dd($supplierFiles);

    /** @var TfileRepository $tfileRep */
    $tfileRep = $this->em->getRepository(Tfile::class);

    $io = new SymfonyStyle($input, $output);
    $io->progressStart(count($supplierFiles));

    foreach($supplierFiles as $supplierFile){

        /** @var $Tfile existingTfile */
        if($existingTfile = $tfileRep->findOneBy(['title' => $supplierFile['test']])){

            $existingTfile->setBody($supplierFile['body']);
            $this->em->persist($existingTfile);

            //dd($existingTfile);

           // continue;
        } else{
        
        $newTfile = new Tfile();
        $newTfile->setTitle($supplierFile['title']);
        $newTfile->setBody($supplierFile['body']);
        $this->em->persist($newTfile);

        }
        $io->progressAdvance();

    }

    $this->em->flush();

    $io->progressFinish();
    $io->success('all good');

    return Command::SUCCESS;
    //dd($rows);
    //dd($this->projectDir);
    }

    public function getCsvRowsAsArrays($processDate){
        $inputFile = $this->projectDir . '/public/csv/' . $processDate . '.csv';

        $row = 1;
        if (($handle = fopen($inputFile, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                //echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
    dd($row);
                }
            }
    
            fclose($handle);
        }
        $decoder = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        return $decoder->decode(file_get_contents($inputFile), 'csv', array(CsvEncoder::DELIMITER_KEY => ';'));
    
    }
}
