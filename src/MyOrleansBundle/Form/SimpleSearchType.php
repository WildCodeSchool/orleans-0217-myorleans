<?php
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 08/06/17
 * Time: 10:45
 */

namespace MyOrleansBundle\Form;


use MyOrleansBundle\Entity\Flat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('ville', SearchType::class, [
                'required'=>false,
                'label'=>'Localisation',
                'attr'=> ['id'=>'autocomplete-input', 'class'=>'autocomplete']

            ])

            ->getForm();
    }
}