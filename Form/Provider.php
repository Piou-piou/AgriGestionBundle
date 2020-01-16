<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Provider
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
                "label" => "Code"
            ])
            ->add("siret", TextType::class, [
                "label" => "Siret"
            ])
            ->add("iban", TextType::class, [
                "label" => "Iban"
            ])
            ->add("comment", TextareaType::class, [
                "label" => "Code"
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
