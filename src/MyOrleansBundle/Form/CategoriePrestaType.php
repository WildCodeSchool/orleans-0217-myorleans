<?php

namespace MyOrleansBundle\Form;

use MyOrleansBundle\Entity\Flat;
use MyOrleansBundle\Entity\Residence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriePrestaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCategorie', TextType::class)
            ->add('flat', EntityType::class, [
                'class' => Flat::class,
                'choice_label' => 'reference'
            ])
            ->add('residence', EntityType::class, [
                'class' => Residence::class,
                'choice_label' =>'nom'
        ])
            ->add('media', MediaType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyOrleansBundle\Entity\CategoriePresta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myorleansbundle_categoriepresta';
    }


}
