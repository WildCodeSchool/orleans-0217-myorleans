<?php

namespace MyOrleansBundle\Form;

use Doctrine\ORM\EntityRepository;
use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\TypeArticle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        $builder->add('titre')
            ->add('texte')
            ->add('date', DateTimeType::class)
            ->add('residence', EntityType::class, ['class' => 'MyOrleansBundle:Residence', 'choice_label' => 'nom'])
            ->add('tags', CollectionType::class,
                array(
                    'entry_type' => TagType::class
                ))
            ->add('typeArticle',EntityType::class, ['class' => TypeArticle::class,
                'choice_label' => 'nom'
            ])
            ->add('medias', CollectionType::class, array(
                'entry_type' => MediaType::class,
                // 'data_class'=> FileType::class
            ));
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
