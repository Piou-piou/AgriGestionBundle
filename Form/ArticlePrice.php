<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Component\Form\AbstractType;
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
                "label" => "Quantité"
            ])
            ->add("quantity_packaging", NumberType::class, [
                "label" => "Quantité du packaging"
            ])
            ->add("packaging", TextType::class, [
                "label" => "Packaging"
            ])
            ->add("price", NumberType::class, [
                "label" => "Prix"
            ])
            ->add("vat", NumberType::class, [
                "label" => "TVA"
            ])
            ->add("currency", TextType::class, [
                "label" => "Devise"
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
