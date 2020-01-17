<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProviderContact extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("firstname", TextType::class, [
                "label" => "Prénom",
                "required" => true
            ])
            ->add("lastname", TextType::class, [
                "label" => "Nom",
                "required" => true
            ])
            ->add("title", TextType::class, [
                "label" => "Titre du contact"
            ])
            ->add("role", TextType::class, [
                "label" => "Poste occupé"
            ])
            ->add("phoneNumber", NumberType::class, [
                "label" => "Téléphone"
            ])
            ->add("mobile", NumberType::class, [
                "label" => "Mobile"
            ])
            ->add("comment", TextareaType::class, [
                "label" => "Commentaire"
            ])
            ->add("providerAddress", EntityType::class, [
                "label" => "Adresse",
                "class" => \PiouPiou\AgriGestionBundle\Entity\ProviderAddress::class,
                "choice_label" => "name"
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\ProviderContact::class,
        ]);
    }
}
