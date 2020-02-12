<?php

namespace App\Form;


use App\Entity\Outing;
use App\Entity\City;
use App\Entity\Place;
use App\Repository\CityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                ]
            )
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'label' => 'Date et heure de la sortie',
                ]
            )
            ->add(
                'limitDateSub',
                DateType::class,
                [
                    'label' => 'Date limite d\'inscription',
                ]
            )
            ->add(
                'numberMaxSub',
                TextType::class,
                [
                    'label' => 'Nombre de places',
                ]
            )
            ->add(
                'duration',
                IntegerType::class,
                [
                    'label' => 'Durée',
                ]
            )
            ->add(
                'description',
                TextType::class,
                [
                    'label' => 'Description et infos',
                ]
            )
            ->add(
                'department',
                EntityType::class,
                [
                    'class' => City::class,
                    'choice_label' => 'department',
                    'mapped' => false,
                    'query_builder' => function (CityRepository $repo) {
                        return $repo->createQueryBuilder('a')
                            ->groupBy('a.department')
                            ->orderBy('a.department', 'ASC');
                    },
                ]
            )
            ->add(
                'city',
                EntityType::class,
                [
                    'class' => City::class,
                    'choice_label' => 'name',
                    'mapped' => false,
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
