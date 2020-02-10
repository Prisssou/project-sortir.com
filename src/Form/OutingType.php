<?php

namespace App\Form;

use App\Entity\Outing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                    'label' => 'Nom de la sortie'
                ]
            )
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'label' => 'Date et heure de la sortie'
                 ]
            )
            ->add(
                'limitDateSub',
                DateType::class,
                [
                    'label' => 'Date limite d\'inscription'
                ]
            )
            ->add(
                'numberMaxSub',
                TextType::class,
                [
                    'label' => 'Nombre de places'
                ]
            )
            ->add(
                'duration',
                TextType::class,
                [
                    'label' => 'Durée'
                ]
            )
            ->add(
                'description',
                TextType::class,
                [
                    'label' => 'Description et infos'
                ]
            )
            //->add('site')
            //->add('state')
            //->add('place')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Outing::class,
        ]);
    }
}
