<?php

namespace MyOrleansBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('page')
            ->add('lien')
            ->add('flats')
            ->add('residences', EntityType::class, ['class'=>'MyOrleansBundle:Residence', 'choice_label'=>'nom'])
            ->add('evenement')
            ->add('partenaire')
            ->add('service')
            ->add('pack')
            ->add('articles', EntityType::class, ['class'=>'MyOrleansBundle:Article', 'choice_label'=>'titre']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyOrleansBundle\Entity\Media'
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
