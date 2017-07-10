<?php

namespace MyOrleansBundle\Form;

use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Quartier;
use MyOrleansBundle\Entity\TypeMedia;
use MyOrleansBundle\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResidenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('adresse', TextType::class)
            ->add('codePostal', NumberType::class)
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom'
            ])
            ->add('quartier',  EntityType::class, [
                'class' => Quartier::class,
                'choice_label' => 'nom'
            ])
            ->add('latitude', NumberType::class, ['required' => false])
            ->add('longitude', NumberType::class, ['required' => false])
            ->add('dateLivraison', TextType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('nbTotalLogements', NumberType::class, ['required' => false])
            ->add('noteTransports', NumberType::class, ['required' => false])
            ->add('noteCommerces', NumberType::class, ['required' => false])
            ->add('noteServices', NumberType::class, ['required' => false])
            ->add('noteEsthetisme', NumberType::class, ['required' => false])
            ->add('favoris', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('affichagePrix',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('eligibilitePinel',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ]
            ])
            ->add('accroche', TextareaType::class)
            ->add('medias', CollectionType::class,
                array(
                    'entry_type' => MediaType::class,
                    'allow_add' => true,
                    'prototype' => true,
                ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyOrleansBundle\Entity\Residence',

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myorleansbundle_residence';
    }


}
