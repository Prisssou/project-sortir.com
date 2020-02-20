<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'adresse',
                TextType::class,
                [
                    'label' => 'Adresse du lieu',
                    'mapped' => false,
                    'attr'=> ['placeholder'=> 'Rechercher une adresse'],
                ]

            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                    'attr'=> ['placeholder'=> 'Nom du lieu'],
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
                    'label' => 'Rue',
                    'attr'=> ['placeholder'=> 'Rue'],

                ]
            )
            ->add(
                'zipcode',
                TextType::class,
                [
                    'label' => 'Code Postal',
                    'attr'=> ['placeholder'=> 'Code Postal'],
                ]
            )
            ->add(
                'latitude',
                TextType::class,
                [
                    'label' => 'Latitude',
                    'attr'=> ['placeholder'=> 'Latitude'],
                ]
            )
            ->add(
                'longitude',
                TextType::class,
                [
                    'label' => 'Longitude',
                    'attr'=> ['placeholder'=> 'Longitude'],
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Ville',
                    'mapped' => false,
                    'attr'=> ['placeholder'=> 'Ville'],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Place::class,
            ]
        );
    }
}
