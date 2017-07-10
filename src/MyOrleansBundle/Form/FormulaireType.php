<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 19/06/17
 * Time: 17:47
 */

namespace MyOrleansBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FormulaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('post')
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephone', TextType::class)
            ->add('codePostal', TextType::class)
            ->add('ville', TextType::class)
            ->add('adresse', TextType::class)
            ->add('sujet', ChoiceType::class, [
                'choices' => ['Infos-residence-principale' => 1,
                                'Infos-appartement' => 2,
                                'Inscription-événement' => 3,
                                'Inscription-newsletter' =>4,
                                'Gestion-locative' =>5,
                                'Location' =>6],
                'expanded' => false,
                'multiple' => false
            ])
            ->add('message', TextareaType::class, [
                'attr' =>['class' => 'materialize-textarea']
            ])
            ->add('newsletter', ChoiceType::class, [
                'choices' => array('oui' => true, 'non' => false),
                'data' => true,

                'expanded' => true,
                'multiple' => false
            ])

            ->add('envoyer', SubmitType::class, [
                'attr'=> ['class' => 'waves-effect waves-light btn-large light-green']
            ])
            ->getForm();

    }
}

