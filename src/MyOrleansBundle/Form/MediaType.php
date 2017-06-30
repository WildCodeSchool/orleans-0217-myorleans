<?php

namespace MyOrleansBundle\Form;

use MyOrleansBundle\Entity\Article;
use MyOrleansBundle\Entity\Evenement;
use MyOrleansBundle\Entity\Media;
use MyOrleansBundle\Entity\Pack;
use MyOrleansBundle\Entity\Partenaire;
use MyOrleansBundle\Entity\Residence;
use MyOrleansBundle\Entity\Service;
use MyOrleansBundle\Entity\TypeMedia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page')
            ->add('lien', FileType::class, array('data_class' => null))
            //->add('flats',  EntityType::class, ['class'=>Evenement::class, 'choice_label'=>'nom'])
            /* ->add('residences', EntityType::class, ['class'=>Residence::class, 'choice_label'=>'nom'])
             ->add('evenement', EntityType::class, ['class'=>Evenement::class, 'choice_label'=>'nom'])
             ->add('partenaire',  EntityType::class, ['class'=>Partenaire::class, 'choice_label'=>'nom'])
             ->add('service',  EntityType::class, ['class'=>Service::class, 'choice_label'=>'type'])
             ->add('pack',  EntityType::class, ['class'=>Pack::class, 'choice_label'=>'nom'])
             ->add('articles', EntityType::class, ['class'=>Article::class, 'choice_label'=>'titre']);*/
            /*       ->add('typemedia', CollectionType::class, array(
                   'entry_type' => TypeMedia::class,
                   //'data_class'=> FileType::class
                   ));*/
            ->add('typemedia', EntityType::class, ['class' => TypeMedia::class,
                'choice_label' => 'nom'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Media::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myorleansbundle_media';
    }


}
