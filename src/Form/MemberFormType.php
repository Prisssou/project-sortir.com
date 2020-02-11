<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class MemberFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, ['label' => 'Identifiant :'])
            ->add('name', TextType::class,['label' => 'Nom de famille :'])
            ->add('firstname',TextType::class,['label' => 'Prénom :'])
            ->add('phone',TelType::class,['label' => 'Numéro de téléphone :'])
            ->add('email', EmailType::class, ['label' => 'Email :'])
            ->add('plainPassword', RepeatedType::class, [
                'label' => false,

                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmation du mot de passe :'],

                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères!',
                        // max length allowed by Symfony for security reasons
                        'max' => 50,
                        'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} caractères!',
                    ]),
                ],
            ])
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
            ->add(
                'site',
                EntityType::class,
                [
                    'class' => Site::class,
                    'label' => 'Site de rattachement',
                    'choice_label' => function ($site) {
                        return $site->getName();
                    },
                ]
            )
//            ->add('roles')
//            ->add('active')
//            ->add('image')
//            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
