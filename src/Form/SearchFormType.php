<?php


namespace App\Form;

use App\Data\SearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add(
//                'q',
//                TextType::class,
//                [
//                    'label' => false,
//                    'required' => false,
//                    'attr' => ['placeholder' => 'Rechercher'],
//                ]
//            )
            ->add(
                'motCle',
                TextType::class,
                [
                    'label' => 'Le nom de la sortie contient:',
                    'required' => false,
                    'attr' => ['placeholder' => 'Envie de faire de l\'escalade?'],
                ]
            )
            ->add(
                'beginDate',
                DateTimeType::class,
                [
                    'required' => false,
                    'choice_translation_domain' => true,
                    'widget' => 'single_text',
                    'format' =>'dd/MM/yyyy H:mm',
                    'html5' => false,
                    'attr' => ['placeholder' => 'Date de début'],


                ]
            )
            ->add(
                'endDate',
                DateTimeType::class,
                [
                    'required' => false,
                    'choice_translation_domain' => true,
                    'widget' => 'single_text',
                    'format' =>'dd/MM/yyyy H:mm',
                    'html5' => false,
                    'attr' => ['placeholder' => 'Date de fin'],

                ]
            )
            ->add('dureeMin', NumberType::class,
                [
                    'label'=>'Durée min:',
                    'required'=>false,
                    'scale'=>0,
                    'attr' => ['placeholder' => 'Durée minimale'],

                ])
            ->add('dureeMax', NumberType::class,
                [
                    'label'=>'Durée max:',
                    'required'=>false,
                    'scale'=>0,
                    'attr' => ['placeholder' => 'Durée maximale'],

                ])
            ->add('orga', CheckboxType::class,
                [
                    'label'=>'Sorties dont je suis l\'organisateur/trice',
                    'required'=> false
                ])
            ->add('inscrit', CheckboxType::class,
                [
                    'label'=>'Sorties auxquelles je suis inscrit/e',
                    'required'=> false
                ])
            ->add('notInscrit', CheckboxType::class,
                [
                    'label'=>'Sorties auxquelles je ne suis pas inscrit/e',
                    'required'=> false,

                ])
            ->add('passee', CheckboxType::class,
                [
                    'label'=>'Sorties passées',
                    'required'=> false
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SearchData::class,
                'method' => 'GET',
                'csrf_protection' => false,


            ]
        );
    }

    public function getBlockPrefix()
    {
        return '';
    }

}