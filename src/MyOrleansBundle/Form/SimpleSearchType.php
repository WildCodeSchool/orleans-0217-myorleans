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


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SimpleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('ville', SearchType::class, [
                'required'=>false,
                'attr'=> ['id'=>'autocomplete-input', 'class'=>'autocomplete', 'autocomplete' => 'off']

            ])

            ->add('type', ChoiceType::class, [
                'required'=>false,
                'placeholder'=>'Sélectionnez le type du bien',
                'choices' => array(
                    'T1' => 'T1',
                    'T2' => 'T2',
                    'T3' => 'T3',
                    'T4+' => 'T4+',
                )
            ])
            ->add('investBtn', SubmitType::class, [
                'label' => 'Je souhaite investir',
                'attr' => ['class' => 'waves-effect waves-light btn-large light-green']
            ])
            ->add('resPrincipaleBtn', SubmitType::class, [
                'label' => 'Je recherche une résidence principale',
                'attr' => ['class' => 'waves-effect waves-light btn-large light-green']
            ])
            ->getForm();
    }
}