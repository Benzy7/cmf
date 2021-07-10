<?php

namespace App\Form;

use App\Entity\StockSearch;
use App\Entity\Stock;

use Symfony\Component\Form\AbstractType;

use App\Entity\TypeAdherent;
use App\Entity\CodeNature;
use App\Entity\Adherent;
use App\Entity\TypeValeur;
use App\Entity\Valeur;

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
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
                'label' => 'Date Comptable : ',
                'required' => true,
                ])
            ->add('Datebdeb',DateType::class,[
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr'=> array('class' => 'form-control', 'style' => 'width: 150px'),
                'required' => true,
                'label' => 'Date Bourse : ',
                ])

            ->add('Sisin',EntityType::class,[
                'class' => Valeur::class,
                'choice_label' =>'CodeValeur',
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
                'required' => false,
                'label' => ' Code valeur :',
            ])
            ->add('Tisin',TextType::class,[
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
                'required' => false,
                'label' => ' Ou '
            ])

            ->add('Scodead',EntityType::class,[
                'class' => Adherent::class,
                'label' => ' Code adhérent :',
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
                'choice_label' =>'NomAdherent',
                'required' => false,
            ])
            ->add('Tcodead',TextType::class,[
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
                'required' => false,
                'label' => ' Ou '
            ]) 

            ->add('Scoden',EntityType::class,[
                'class' => CodeNature::class,
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
                'choice_label' =>'CodeNatureCompte',
                'required' => false,
                'label' => ' Nature du compte :',
            ])
            ->add('Tcoden',TextType::class,[
                'attr' => array('class' => 'form-control', 'style' => 'width: 150px'),
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
            ->add('TypeValeurs',EntityType::class,[
                'class' => TypeValeur::class,
                'label' => "Types des Valeurs :",
                'attr' => array('class' => 'form-control'),
                'choice_label' => 'LibelleTypeValeur',
                'multiple'  => true,
                'required' => false,
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
                //$dateComptable = $form->get('Dateadeb');
                //$dateBourse =  DateTimeToStringTransformer($dateBourse);
                $form->get('Dateadeb')->setData(\Datetime::createFromFormat('Y-m-d', '2021-03-23'));
                //$dateBourse = $data->getDateadeb();
                //$form->get('Datebdeb')->setData($data->getDateadeb()->format('Y-m-d'));
            }
            else{
                return null;
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
