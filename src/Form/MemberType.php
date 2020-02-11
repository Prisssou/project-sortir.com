<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


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
                    'label' => 'Nom :',
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'Nom :',
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Nom :',
                ]
            )
            ->add(
                'password',
                PasswowordType::class,
                [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => 'mot de passe : ',
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank(
                            [
                                'message' => 'Please enter a password',
                            ]
                        ),
                        new Length(
                            [
                                'min' => 6,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]
                        ),
                    ],
                ]
            )
            ->add(
                'admin'
            )
            ->add('active')
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Avatar :  ',

                    // unmapped means that this field is not associated to any entity property
                    'mapped' => false,

                    // make it optional so you don't have to re-upload the PDF file
                    // everytime you edit the Product details
                    'required' => false,

                    // unmapped fields can't define their validation using annotations
                    // in the associated entity, so you can use the PHP constraint classes
//            'constraints' => [
//                new File(
//                    [
//                        'maxSize' => '5024k',
//                        'mimeTypes' => [
//                            'application/jpeg',
//                            'application/jpg',
//                            'application/png',
//                        ],
//                        'mimeTypesMessage' => 'Please upload a valid Image',
//                    ]
//                ),
//            ],
                ]
            )
            ->add('site');
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
