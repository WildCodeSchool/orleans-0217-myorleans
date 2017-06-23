<?php
/**
 * Created by PhpStorm.
 * User: wilder3
 * Date: 19/06/17
 * Time: 17:15
 */

namespace MyOrleansBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CompleteSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('ville', SearchType::class, [
                'required'=>false,
                'attr'=> ['id'=>'autocomplete-input', 'class'=>'autocomplete', 'autocomplete' => 'off']

            ])
            ->add('quartier', SearchType::class, [
                'required'=>false,
                'attr'=> ['id'=>'autocomplete-input', 'class'=>'autocomplete-quartier', 'autocomplete' => 'off']

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
            ->add('surfaceMin', IntegerType::class, [
                'required' => false,
                'attr' => ['placeholder'=>'Surface min'],
            ])
            ->add('surfaceMax', IntegerType::class, [
                'required' => false,
                'attr' => ['placeholder'=>'Surface min'],
            ])
            ->add('nbChambres', ChoiceType::class, [
                'required'=>false,
                'placeholder'=>'Nb. Chambre(s)',
                'choices' => array(
                    '1 chambre' => '1',
                    '2 chambres' => '2',
                    '3 chambres' => '3',
                    '4 chambres et plus' => '4',
                )
            ])
            ->add('nbPieces', ChoiceType::class, [
                'required'=>false,
                'placeholder'=>'Nb. Pièce(s)',
                'choices' => array(
                    '1 pièce' => '1',
                    '2 pièces' => '2',
                    '3 pièces' => '3',
                    '4 pièces et plus' => '4',
                )
            ])
            ->add('objectif', ChoiceType::class, [
                'required'=>false,
                'placeholder'=>'Objectif',
                'choices' => array(
                    'investir' => '1',
                    'acheter en résidence principale' => '2',
                )
            ])
            ->add('budgetMin', IntegerType::class, [
                'required' => false,
                'attr' => ['placeholder'=>'Budget min'],
            ])
            ->add('budgetMax', IntegerType::class, [
                'required' => false,
                'attr' => ['placeholder'=>'Budget max'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher',
                'attr' => ['class' => 'waves-effect waves-light btn-large light-green']
            ])
            ->getForm();

    }

}