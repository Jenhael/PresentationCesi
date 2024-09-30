<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'label' => false,
                'placeholder' => 'Civilité',
                'choices' => [
                    'M.' => 'Monsieur',
                    'Mme' => 'Madame',
                    'Mlle' => 'Mademoiselle',
                ]
            ])
            ->add('formations', EntityType::class, [
                'class' => Formations::class,
                'label' => false,
                'placeholder' => 'Choisissez une formation',
                'multiple' => true,
                'expanded' => true,
                'choice_label' => 'formation',
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom',
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prénom',
                ]
            ])
            ->add('date_de_naissance', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Date de naissance',
                    'class' => 'datepicker',
                    'autocomplete' => 'off',
                    'maxlength' => 10,
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Adresse',
                ]
            ])
            ->add('code_postal', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Code postal',
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Ville',
                ]
            ])
            ->add('diplome', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Diplome',
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Telephone',
                ]
            ])
            ->add('pays', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Pays',
                ]
            ])
            ->add('cv', FileType::class, [
                'label' => 'CV',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Choose CV file',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
