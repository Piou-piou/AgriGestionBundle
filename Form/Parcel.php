<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PiouPiou\RibsAdminBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Parcel extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var EntityManager $em */
        $em = $options["em"];
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
