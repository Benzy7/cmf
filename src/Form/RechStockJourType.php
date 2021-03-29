<?php

namespace App\Form;

use App\Entity\StockSearch;
use App\Entity\Stock;

use Symfony\Component\Form\AbstractType;

use App\Entity\TypeAdherent;
use App\Entity\CodeNature;
use App\Entity\Adherent;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\DataCollector\EventListener\DataCollectorListener;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechStockJourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Dateadeb',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'label' => 'Date Comptable : ',
                'required' => true,
                ])
            ->add('Datebdeb',DateType::class,[
                'attr'=> array('class' => 'form-control'),
                'required' => true,
                'label' => 'Date Bourse : ',
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

            ->add('Scoden',EntityType::class,[
                'class' => CodeNature::class,
                'attr' => array('class' => 'form-control'),
                'choice_label' =>'CodeNatureCompte',
                'required' => false,
                'label' => ' Nature du compte :',
            ])
            ->add('Tcoden',TextType::class,[
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'label' => ' Ou '
            ]) 

            ->add('TypeAdherents',EntityType::class,[
                'class' => TypeAdherent::class,
                'label' => "Types d'Adhérents :",
                'attr' => array('class' => 'form-control'),
                'choice_label' => 'CodeTypeAdherent',
                'multiple'  => true,
                'required' => false,
            ]) 
            ->add('Valeurs',ChoiceType::class,[
                'label' => ' Types des valeurs :',
                'attr' => array('class' => 'form-control'),
                'required' => false,
                'multiple'  => true,
                  'choices'  => [
                    'Test007' => '007',
                    'Action a dividende prioritaire' => '002',
                    'Action nouvelle garatuite' => '004',
                    ]
            ])

            ->add('submit', SubmitType::class,[
                'attr'=> array('class' => 'form-control btn btn-secondary btn-lg'),
                'label' => 'Chercher'
            ])
        ;

         $builder->addEventListener(
            FormEvents::POST_SET_DATA, 
            function (FormEvent $event){

            $form = $event->getForm();
            $data = $event->getData();
            
            if($data){
                $dateBourse = $form->get('Dateadeb');
                //$dateBourse =  DateTimeToStringTransformer($dateBourse);
                $form->get('Datebdeb')->setData(\Datetime::createFromFormat('Y-m-d', '2016-05-13'));
                //$dateBourse = $data->getDateadeb();
                //$form->get('Datebdeb')->setData($data->getDateadeb()->format('Y-m-d'));
            }
            else{
                return;
            }            
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StockSearch::class,
        ]);
    }
}
