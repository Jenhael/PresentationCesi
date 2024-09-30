<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\PositionIntervenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PositionIntervenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('formations', EntityType::class, [
                'mapped' => false,
                'class' => Formations::class,
                'label' => false,
                'placeholder' => 'Choisissez une formation',
                'multiple' => false,
                'choice_label' => 'formation',
                'choice_attr' => function ($choice, $key, $value) {
                    return ['class' => 'position_intervenant_checkbox'];
                },
            ])
            ->add('modules', CollectionType::class, [
                'label' => false,
                'mapped' => false,
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'required' => false,
                'entry_options' => [
                    'attr' => ['placeholder' => 'Votre diplome'],
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PositionIntervenant::class,
        ]);
    }
}
