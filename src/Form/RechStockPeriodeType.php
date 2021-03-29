<?php

namespace App\Form;

use App\Entity\StockSearch;

use App\Entity\Adherent;
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
            'attr'=> array('class' => 'form-control'),
            'label' => 'Date Comptable du : ',
            'required' => true,
            ])
        ->add('Dateafin',DateType::class,[
            'attr'=> array('class' => 'form-control'),
            'label' => ' Au : ',
            'required' => true,
            ])

        ->add('Datebdeb',DateType::class,[
            'attr'=> array('class' => 'form-control'),
            'required' => true,
            'label' => ' Date Bourse de : ',
            ])
        ->add('Datebfin',DateType::class,[
            'attr'=> array('class' => 'form-control'),
            'required' => true,
            'label' => ' Au : ',
            ])

        ->add('Sisin',ChoiceType::class,[
            'attr' => array('class' => 'form-control'),
            'required' => false,
            'label' => ' Code valeur :',
            'choices'  => [
                'TN0001000108' => 'TN0001000108',
                'TN0001100254' => 'TN0001100254',
            ],
        ])
        ->add('Tisin',TextType::class,[
            'attr' => array('class' => 'form-control'),
            'required' => false,
            'label' => ' Ou '
        ])

        ->add('Scodead',EntityType::class,[
            'class' => Adherent::class,
            'label' => ' Code adhérent :',
            'attr' => array('class' => 'form-control'),
            'choice_label' =>'NomAdherent',
            'required' => false,
        ])

        ->add('Tcodead',TextType::class,[
            'attr' => array('class' => 'form-control'),
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
