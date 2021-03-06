<?php

namespace App\Form;


use App\Entity\Outing;
use App\Entity\Ville;
use App\Entity\Site;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom de la sortie',
                    'attr'=> ['placeholder'=> 'Nom de la sortie'],
                ]
            )
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'label' => 'Date et heure de la sortie',
                    'choice_translation_domain' => true,
                    'widget' => 'single_text',
                    'format' =>'dd/MM/yyyy H:mm',
                    'html5' => false,
                    'attr'=> ['placeholder'=> 'Date et heure de la sortie'],
                ]
            )
            ->add(
                'limitDateSub',
                DateType::class,
                [
                    'label' => 'Date limite d\'inscription',
                    'choice_translation_domain' => true,
                    'widget' => 'single_text',
                    'format' =>'dd/MM/yyyy H:mm',
                    'html5' => false,
                    'attr'=> ['placeholder'=> 'Date limite d\'inscription'],
                ]
            )
            ->add(
                'numberMaxSub',
                IntegerType::class,
                [
                    'label' => 'Nombre de places',
                    'attr'=> ['placeholder'=> 'Nombre de places'],
                ]
            )
            ->add(
                'duration',
                IntegerType::class,
                [
                    'label' => 'Durée (en minutes)',
                    'attr'=> ['placeholder'=> 'Durée (en minutes)'],
                ]
            )
            ->add(
                'description',
                TextType::class,
                [
                    'label' => 'Description et infos',
                    'attr'=> ['placeholder'=> 'Description et infos'],

                ]
            )
            ->add(
                'ville',
                EntityType::class,
                [
                    'class' => Ville::class,
                    'choice_label' => function ($ville) {
                        return $ville->getNom().' '.$ville->getCodesPostaux();
                    },
                    'mapped' => false,
                    'placeholder' => 'Choisir la ville',
                    'attr' => [
                        'class' => 'select2',

                    ],
                ]
            )
            ->add(
                'place',
                EntityType::class,
                [
                    'class' => Place::class,
                    'label' => 'Lieu',
                    'choice_label' => function ($place) {
                        return $place->getName();
                    },
                    'placeholder'=> 'Choisir le lieu',

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Outing::class,
            ]
        );
    }
}
