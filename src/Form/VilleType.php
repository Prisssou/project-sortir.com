<?php

namespace App\Form;

use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
                TextType::class,
                [
                    'label' => 'Nom de la ville',
                    'attr'=> ['placeholder'=> 'Nom de la ville'],
                ])

            ->add('codesPostaux',
                TextType::class,
                [
                    'label' => 'Code postal de la ville',
                    'attr'=> ['placeholder'=> 'Code postal'],
                ])

            ->add('departement',
                TextType::class,
                [
                    'label' => 'Numéro de département',
                    'attr'=> ['placeholder'=> 'Numéro de département'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ville::class,
        ]);
    }
}
