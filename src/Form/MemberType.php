<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Site;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                TextType::class,
                [
                    'label' => 'Pseudo : ',
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Nom :',
                ]
            )
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénom :',
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'Téléphone :',
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Email :',
                ]
            )
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe ne correspondent pas.',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options' => ['label' => 'Mot de passe :'],
                    'second_options' => ['label' => 'Confirmation du mot de passe :'],
                    'label' => ' ',
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Merci d\'entrer un mot de passe',
                            ]
                        ),
                        new Length(
                            [
                                'min' => 8,
                                'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères!',
                                // max length allowed by Symfony for security reasons
                                'max' => 50,
                                'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} caractères!',
                            ]
                        ),
                    ],
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

            // Upload de l'image
            ->add(
                'image',
                ImageType::class
//                [
//                    'label' => 'Avatar :  ',
//
//                    // unmapped means that this field is not associated to any entity property
//                    'mapped' => false,
//
//                    // make it optional so you don't have to re-upload the PDF file
//                    // everytime you edit the Product details
//                    'required' => false,
//
//                    // unmapped fields can't define their validation using annotations
//                    // in the associated entity, so you can use the PHP constraint classes
////            'constraints' => [
////                new File(
////                    [
////                        'maxSize' => '5024k',
////                        'mimeTypes' => [
////                            'application/jpeg',
////                            'application/jpg',
////                            'application/png',
////                        ],
////                        'mimeTypesMessage' => 'Please upload a valid Image',
////                    ]
////                ),
////            ],
//                ]
            );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Member::class,
            ]
        );
    }
}
