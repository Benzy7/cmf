<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\MouvementSearch;
use App\Entity\Mouvement;
use App\Entity\Operation;


use Symfony\Component\Form\AbstractType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechMouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Datebdeb',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'required' => true,
                'label' => 'Date Bourse du : ',
                ])
            ->add('Datebfin',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'required' => true,
                'label' => 'Au : ',
                ])
            ->add('Dateadeb',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'label' => 'Date Comptable du : ',
                'required' => true,
                ])
            ->add('Dateafin',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'label' => 'Au : ',
                'required' => true,
                ])
            ->add('Sisin',ChoiceType::class,[
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'label' => ' Code Valeur :',
                'choices'  => [
                    'TN0002300572' => 'TN0002300572',
                    'TN0002300358' => 'TN0002300358',
                ],
            ])
            ->add('Tisin',TextType::class,[
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'label' => ' Ou '
            ])

            ->add('Scodeop',EntityType::class,[
                'class' => Operation::class,
                'attr' => array('class' => 'form-control'),
                'label' => ' Code Opération : ',
                'choice_label' => 'CodeOperation',
                'required' => false,
                'placeholder' => '',
                'empty_data' => null,
            ])

            ->add('Tcodeop',TextType::class,[
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'label' => ' Ou '
            ])      
         
            ->add('Livreurs',EntityType::class,[
                'class' => Adherent::class,
                'label' => ' Adhérents : Livreurs',
                'attr' => array('class' => 'form-control'),
                'choice_label' => 'NomAdherent',
                'multiple'  => true,
                'required' => false,
            ]) 
            ->add('Livres',EntityType::class,[
                'class' => Adherent::class,
                'choice_label' => 'NomAdherent',
                'label' => 'Livrés',
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'multiple'  => true,
         
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
            'data_class' => MouvementSearch::class,
        ]);
    }
}
