<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 19/06/17
 * Time: 17:47
 */

namespace MyOrleansBundle\Form;


use MyOrleansBundle\Entity\Client;
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
                'choices' => ['Infos residence principale' => Client::SUJET_INFO_RESID_PRINC,
                                'Infos appartement' => Client::SUJET_INFO_APPART,
                                'Inscription événement' => Client::SUJET_INSCRIPT_EVENT,
                                'Inscription newsletter' => Client::SUJET_INSCR_NEWSLETTER,
                                'Infos services' => Client::SUJET_SERVICES,
                                'Autres' => Client::SUJET_AUTRES],
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

