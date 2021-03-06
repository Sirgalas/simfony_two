<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description',TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control summernote'
                    ],
                ])
            ->add('small_description',TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control summernote'
                    ],
                ])
            ->add('price')
            ->add('genre',EntityType::class,[
                'class'=>Genre::class,
                'choice_label' => function (Genre $genre) {
                    return $genre->getTitle();
                },
                'attr' => [
                    'class' => 'select2 form-control',
                ],
                'placeholder' =>'Выбирите жанр'
                ])
            ->add('author',EntityType::class,[
                'class'=>Author::class,
                'multiple' => true,
                'placeholder' =>'Выбирите автора',
                'choice_label' => function (Author $author) {
                    return $author->getFullName();
                },
                'attr' => [
                    'class' => 'select2multiple form-control',
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
