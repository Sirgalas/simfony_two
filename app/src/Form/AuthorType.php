<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AuthorType
 * @package App\Form
 * @property string $family
 * @property string $name
 * @property string $ptaronic
 * @property string $biograpfy
 * @property string $books
 */
class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('family')
            ->add('name')
            ->add('patronic')
            ->add('biograpfy',
                TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control summernote'
                    ],
                ])
            /*->add('books',EntityType::class,[
                'class'=>Book::class,
                'choice_label' => function (Book $book) {
                    return $book->getTitle();
                },
                'attr' => ['class' => 'select2 form-control'],
            ])
           /* ->add('files', FileType::class,
                [
                    'multiple'=>true,
                    'attr' => [
                        'class' => 'custom-file-input'
                    ],
                ]
            )*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
