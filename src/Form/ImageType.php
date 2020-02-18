<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add(
                'url',
                FileType::class,

                [
                    'data_class' => null,
                    'label' => false,

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
            );
//            ->add('member')
//            ->add('Outing');
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
     $entity = $form->getParent()->getData();

     if ($entity) {
         $view->vars['file_uri'] = (null === $entity->getImage()->getUrl()) ? null : '/uploads/images' . $entity->getImage()->getUrl();
     }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'file_uri' => null,
                'data_class' => Image::class,
            ]
        );
    }
}
