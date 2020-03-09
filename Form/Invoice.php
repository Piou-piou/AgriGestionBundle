<?php

namespace PiouPiou\AgriGestionBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Invoice extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("number", IntegerType::class, [
                "label" => "Numéro",
                "required" => true
            ])
            ->add("date", DateType::class, [
                "label" => "Date",
                "required" => true
            ])
            ->add("payment_date", DateType::class, [
                "label" => "Date de paiement",
                "required" => true
            ])
            ->add("due_date", DateType::class, [
                "label" => "Date paiement du",
                "required" => true
            ])
            ->add("payment_method", ChoiceType::class, [
                "label" => "Méthode de paiement",
                "required" => true
            ])
            ->add("currency", ChoiceType::class, [
                "label" => "Devise",
                "choices" => \PiouPiou\AgriGestionBundle\Entity\ArticlePrice::CURRENCY_TYPE,
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
            ->add("submit", SubmitType::class, [
                "label" => "Validate",
                "attr" => []
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\Invoice::class,
        ]);
    }
}
