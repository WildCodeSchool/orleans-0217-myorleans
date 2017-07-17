<?php

namespace MyOrleansBundle\Form;

use MyOrleansBundle\Entity\TypeBien;
use MyOrleansBundle\Entity\TypeLogement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', TextType::class)
            ->add('prix', NumberType::class)
            ->add('surface', NumberType::class)
            ->add('nbPiece', NumberType::class)
            ->add('description', TextareaType::class)
            ->add('prestationComplementaire', TextareaType::class, [
                'required' => false
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Disponible' => true,
                    'Vendu' => false
                ]
            ])
            ->add('typeLogement', EntityType::class, [
                'class' => TypeLogement::class,
                'choice_label' => 'nom'
            ])
            ->add('typeBien', EntityType::class, [
                'class' => TypeBien::class,
                'choice_label' => 'nom'
            ])
            ->add('medias', CollectionType::class,
                [
                    'entry_type' => MediaType::class,
                    'allow_add' => true,
                    'prototype' => true,
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyOrleansBundle\Entity\Flat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myorleansbundle_flat';
    }


}
