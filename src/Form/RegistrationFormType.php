<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'attr' => ['class' => 'input'],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'attr' => ['class' => 'input'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => ['class' => 'input'],
            ])
            ->add('plainPassword', PasswordType::class, [
                // Ce champ n'est pas enregistré tel quel dans l'entité User :
                // le mot de passe est hashé dans le contrôleur
                'mapped' => false,
                'label' => 'Mot de passe :',
                'attr' => [
                    'class' => 'input',
                    'autocomplete' => 'new-password',
                ],
                'constraints' => [
                    new NotBlank(
                        message: 'Veuillez saisir un mot de passe.',
                    ),
                    new Length(
                        min: 6,
                        minMessage: 'Votre mot de passe doit contenir au moins {{ limit }} caractères.',
                        // longueur maximale autorisée par Symfony pour des raisons de sécurité
                        max: 4096,
                    ),
                ],
            ])
            ->add('icon', FileType::class, [
                'label'=> 'Importer une image de profil au format png',
                'constraints' =>[
                    new Assert\File(
                        maxSize: '1024k',
                        extensions: ['png'],
                        extensionsMessage: 'Veuillez choisir un fichier .png',
                    )
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => "J'accepte les conditions d'utilisation",
                'constraints' => [
                    new IsTrue(
                        message: "Vous devez accepter les conditions d'utilisation.",
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}