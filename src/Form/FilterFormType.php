<?php

namespace App\Form;

use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'site',
                EntityType::class,
                [
                    'class' => Site::class,
                    'label' => 'Ville organisatrice',
                    'choice_label' => function ($site) {
                        return $site->getName();
                    },
                ]
            )
            ->add('clue', TextType::class, ['label' => 'Ville organisatrice'])
            ->add(
                'startDate',
                DateTimeType::class,
                [
                    'label' => 'Entre ',
                ]
            )
            ->add(
                'endDate',
                DateTimeType::class,
                [
                    'label' => 'Et  ',
                ]
            )
            ->add(
                'public', ChoiceType::class, array(
                'choices' => array(
                    'value1' => 'Sorties dont je suis l\'organisateur/trice',
                    'value2' => 'Sorties auxquelles je suis inscrit/e',
                    'value3' => 'Sorties auxquelles je ne suis pas inscrit/e',
                    'value4' => 'Sorties passées',),
                    'multiple' => true, 'expanded' => true
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                // Configure your form options here
            ]
        );
    }
}
