<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlePrice extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("reference", TextType::class, [
                "label" => "Référence",
                "required" => true
            ])
            ->add("quantity", NumberType::class, [
                "label" => "Quantité",
                "required" => true
            ])
            ->add("quantity_packaging", NumberType::class, [
                "label" => "Quantité du packaging",
                "required" => true
            ])
            ->add("packaging", TextType::class, [
                "label" => "Packaging",
                "required" => true
            ])
            ->add("price", NumberType::class, [
                "label" => "Prix HT",
                "required" => true
            ])
            ->add("vat", NumberType::class, [
                "label" => "TVA",
                "required" => true
            ])
            ->add("currency", ChoiceType::class, [
                "label" => "Devise",
                "choices" => \PiouPiou\AgriGestionBundle\Entity\ArticlePrice::CURRENCY_TYPE,
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
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\ArticlePrice::class,
        ]);
    }
}
