<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Parcel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Désignation",
                "attr" => [
                    "autocomplete" => "off",
                ],
                "required" => true
            ])
            ->add("surface", TextType::class, [
                "label" => "Surface (en hectares)",
                "required" => true
            ])
            ->add("type", ChoiceType::class, [
                "label" => "Type",
                "choices" => \PiouPiou\AgriGestionBundle\Entity\Parcel::retrieveTypeLabels(),
                "empty_data" => "COWS",
                "required" => true
            ])
            ->add("submit", SubmitType::class, [
                "label" => "Validate",
                "attr" => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\Parcel::class,
            "em" => null,
        ]);
    }
}
