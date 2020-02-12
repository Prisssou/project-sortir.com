<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'url',
                FileType::class,
                array('data_class' => null),
                [
                    'label' => 'Avatar :  ',

                    // unmapped means that this field is not associated to any entity property


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
            );
//            ->add('member')
//            ->add('Outing');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Image::class,
            ]
        );
    }
}
