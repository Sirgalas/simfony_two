<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description',
                TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control summernote'
                    ],
                ])
            ->add('parent',EntityType::class,[
                'class'=>Genre::class,
                'choice_label' => function (Genre $genre) {
                    return $genre->getTitle();
                },
                'attr' => [
                    'class' => 'select2 form-control',
                ],
                'placeholder' =>'Выбирите родительский жанр',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Genre::class,
        ]);
    }
}
