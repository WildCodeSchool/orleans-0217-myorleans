<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 08/06/17
 * Time: 13:25
 */

namespace MyOrleansBundle\Form;


use MyOrleansBundle\Entity\Flat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class SimpleSearchType
{
    public function buildForm(FormBuilderInterface $builder)
    {
        $builder
            ->setMethod('GET')
            ->add('localisation', SearchType::class, [
                'required'=>false,
                'attr'=>['placeholder'=>'Localisation']
            ])
            ->add('type', EntityType::class, [
                'class'=>Flat::class,
                'required'=>false,
                'choice_label'=>'type',
                'attr'=>['placeholder'=>'Sélectionnez le type de bien']
            ]);
    }

}