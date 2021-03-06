<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Provider extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("shortName", TextType::class, [
                "label" => "Nom court",
                "required" => true
            ])
            ->add("name", TextType::class, [
                "label" => "Nom",
                "required" => true
            ])
            ->add("code", TextType::class, [
                "label" => "Code",
                "required" => false
            ])
            ->add("siret", TextType::class, [
                "label" => "Siret",
                "required" => false
            ])
            ->add("iban", TextType::class, [
                "label" => "Iban",
                "required" => false
            ])
            ->add("comment", TextareaType::class, [
                "label" => "Commentaire",
                "required" => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Validate',
                'attr' => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\Provider::class,
        ]);
    }
}
