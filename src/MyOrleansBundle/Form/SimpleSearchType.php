<?php
/**
 * Created by PhpStorm.
<<<<<<< HEAD
 * User: wilder3
 * Date: 08/06/17
 * Time: 13:25
=======
 * User: wilder8
 * Date: 08/06/17
 * Time: 10:45
>>>>>>> 336e23ad00f6d8c44f5fe810a39e7c9657852d68
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
/*            ->add('type', EntityType::class, [
                'class'=>Flat::class,
                'choice_label'=>'type',
                'required'=>false,
                'attr'=> ['placeholder'=>'Sélectionnez le type du bien']
            ])*/
            ->getForm();
    }
}