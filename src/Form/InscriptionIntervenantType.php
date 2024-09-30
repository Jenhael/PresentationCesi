<?php

namespace App\Form;

use App\Entity\Competances;
use App\Entity\InscriptionIntervenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class InscriptionIntervenantType extends AbstractType
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
                    'placeholder' => 'Date de naissance, ex: 0000-00-00',
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
            ->add('code_postale', TextType::class, [
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
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Téléphone',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InscriptionIntervenant::class,
        ]);
    }
}
