<?php

namespace MyOrleansBundle\Form;

use Doctrine\ORM\EntityRepository;
use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\TypeArticle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class)
            ->add('texte', TextareaType::class, [
                "attr" => [
                    "class" => "materialize ckeditor"
                ]
            ])
            ->add('date', DateTimeType::class)
            ->add('residence', EntityType::class, [
                'class' => Residence::class,
                'choice_label' => 'nom'
            ])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('typeArticle', EntityType::class, [
                'class' => TypeArticle::class,
                'choice_label' => 'nom'
            ])
            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'allow_add' => true,
                'prototype' => true,
            ])
            ->add('fichierAssocie', FileType::class, [
                'data_class' => null,
                'required'=>false
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Article::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myorleansbundle_article';
    }


}
