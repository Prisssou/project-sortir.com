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
                ]

            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom',
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
                    'label' => 'Rue',
                ]
            )
            ->add(
                'zipcode',
                TextType::class,
                [
                    'label' => 'Code Postal'
                ]
            )
            ->add(
                'latitude',
                TextType::class,
                [
                    'label' => 'Latitude',
                ]
            )
            ->add(
                'longitude',
                TextType::class,
                [
                    'label' => 'Longitude',
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Ville',
                    'mapped' => false
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
