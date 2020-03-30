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

class Article extends AbstractType
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
            ->add("reference", TextType::class, [
                "label" => "Reference",
                "required" => true
            ])
            ->add("comment", TextareaType::class, [
                "label" => "Commentaire",
                "required" => false
            ])
            ->add("provider_autocomplete", AutocompleteType::class, [
                "label" => "Fournisseur",
                "autocomplete_name" => "autocomplete",
                "data_url" => "agrigestion_admin_provider_autocomplete",
                "mapped" => false,
                "required" => false,
            ])
            ->add("submit", SubmitType::class, [
                "label" => "Validate",
                "attr" => []
            ]);

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($em) {
            $form = $event->getForm();
            $data = $event->getData();
            $provider_id = $form->get('provider_autocomplete')->get('autocomplete_id')->getData();
            $provider = $em->getRepository(\PiouPiou\AgriGestionBundle\Entity\Provider::class)->find($provider_id);
            $data->setProvider($provider);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => \PiouPiou\AgriGestionBundle\Entity\Article::class,
            "em" => null,
        ]);
    }
}
