<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Article extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Désignation",
                "required" => true
            ])
            ->add("reference", TextType::class, [
                "label" => "Reference",
                "required" => true
            ])
            ->add("comment", TextareaType::class, [
                "label" => "Commentaire",
                "required" => false
            ])
            ->add("provider", EntityType::class, [
                "label" => "Fournisseur",
                "class" => \PiouPiou\AgriGestionBundle\Entity\Provider::class,
                "query_builder" => function (EntityRepository $er) {
                    return $er->createQueryBuilder("p")
                        ->orderBy("p.name", "ASC");
                },
                "choice_label" => "name",
                "required" => true
            ])
            /*->add("providerAutocomplete", TextType::class, [
                "label" => "Fournisseur autocomplete",
                "attr" => [
                    "class" => "input-autocomplete",
                ],
                "required" => false,
                "mapped" => false
            ])*/
            ->add("submit", SubmitType::class, [
                "label" => "Validate",
                "attr" => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\Article::class,
        ]);
    }
}
