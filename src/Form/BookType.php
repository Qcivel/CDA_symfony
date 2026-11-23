<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du livre',
                "attr" => ["class" => "input"],
                'required'=> true
            ])
            ->add('resume', TextareaType::class, [
                'label' => 'résumé du livre',
                "attr" => ["class" => "input"]
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur du livre',
                "attr" => ["class" => "input"]
            ])
            ->add('publishAt', DateType::class, [
                "widget"=>'single_text',
                'input'  => 'datetime_immutable',
                'required'=> true
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégories',
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ])
            ->add('save', SubmitType::class, [
                'label'=> 'Ajouter',
                'attr' => ['class' => 'save']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
