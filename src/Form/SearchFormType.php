<?php


namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
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
            ->add(
                'q',
                TextType::class,
                [
                    'label' => false,
                    'required' => false,
                    'attr' => ['placeholder' => 'Rechercher'],
                ]
            )
            ->add(
                'motCle',
                TextType::class,
                [
                    'label' => 'Le nom de la sortie contient:',
                    'required' => false,
                    'attr' => ['placeholder' => 'Search'],
                ]
            )
            ->add(
                'beginDate',
                DateTimeType::class,
                [
                    'label' => 'Entre le ',
                    'required' => false,
                    'choice_translation_domain' => true,
                    'date_widget' => 'single_text',

                ]
            )
            ->add(
                'endDate',
                DateTimeType::class,
                [
                    'label' => 'Et le ',
                    'required' => false,
                    'choice_translation_domain' => true,
                    'date_widget' => 'single_text',

                ]
            )
            ->add('duree', NumberType::class,
                [
                    'label'=>'Durée:',
                    'required'=>false,
                    'scale'=>0,

                ])
            ->add('orga',)
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