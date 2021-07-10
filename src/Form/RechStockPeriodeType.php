<?php

namespace App\Form;

use App\Entity\StockSearch;

use App\Entity\Adherent;
use App\Entity\Valeur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechStockPeriodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Dateadeb',DateType::class,[
            'widget' => 'single_text',
            'data' => new \DateTime(),
            'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
            'label' => 'Date Comptable du : ',
            'required' => true,
            ])
        ->add('Dateafin',DateType::class,[
            'widget' => 'single_text',
            'data' => new \DateTime(),
            'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
            'label' => ' Au : ',
            'required' => true,
            ])

        ->add('Datebdeb',DateType::class,[
            'widget' => 'single_text',
            'data' => new \DateTime(),
            'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
            'required' => true,
            'label' => ' Date Bourse de : ',
            ])
        ->add('Datebfin',DateType::class,[
            'widget' => 'single_text',
            'data' => new \DateTime(),
            'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
            'required' => true,
            'label' => ' Au : ',
            ])

        ->add('Sisin',EntityType::class,[
            'class' => Valeur::class,
            'label' => ' Code Valeur :',
            'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
            'choice_label' =>'CodeValeur',
            'required' => false,
        ])
        ->add('Tisin',TextType::class,[
            'attr' => array('class' => 'form-control' , 'style' => 'width: 150px'),
            'required' => false,
            'label' => ' Ou '
        ])

        ->add('Scodead',EntityType::class,[
            'class' => Adherent::class,
            'label' => ' Code Adhérent :',
            'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
            'choice_label' =>'NomAdherent',
            'required' => false,
        ])

        ->add('Tcodead',TextType::class,[
            'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
            'required' => false,
            'label' => ' Ou '
        ]) 

        ->add('submit', SubmitType::class,[
            'attr'=> array('class' => 'form-control btn btn-secondary btn-lg'),
            'label' => 'Chercher'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StockSearch::class,
        ]);
    }
}
