<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderAddress extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom",
                "required" => true
            ])
            ->add("address", TextType::class, [
                "label" => "Adresse",
                "required" => true
            ])
            ->add("address1", TextType::class, [
                "label" => "Complément d'adresse",
                "required" => false
            ])
            ->add("postalCode", NumberType::class, [
                "label" => "Code postal",
                "required" => true
            ])
            ->add("city", TextType::class, [
                "label" => "Ville",
                "required" => true
            ])
            ->add("state", TextType::class, [
                "label" => "Région",
                "required" => true
            ])
            ->add("country", TextType::class, [
                "label" => "Pays",
                "required" => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\ProviderAddress::class,
        ]);
    }
}
