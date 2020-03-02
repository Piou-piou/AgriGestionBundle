<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\MappingException;
use PiouPiou\AgriGestionBundle\Entity\Provider;
use PiouPiou\AgriGestionBundle\Entity\ProviderAddress;
use PiouPiou\AgriGestionBundle\Entity\ProviderContact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    use SearchEngineTrait;

    /**
     * @Route("/providers/list/", name="agrigestion_admin_provider_index")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws MappingException
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $providers = $this->doSearch($em, $request->get("search") ?? [], Provider::class);

        return $this->render("@AgriGestion/admin/providers/index.html.twig", [
            "providers" => $providers,
            "searches" => $this->getSearches()
        ]);
    }

    /**
     * @Route("/providers/autocomplete/", name="agrigestion_admin_provider_autocomplete")
     * @param Request $request
     * @return Response
     */
    public function autocomplete(Request $request): Response
    {
        $providers = $this->getDoctrine()->getRepository(Provider::class)->autocomplete($request->get("autocomplete"));

        return $this->render("@AgriGestion/admin/providers/autocomplete.html.twig", [
            "autocomplete_results" => $providers
        ]);
    }

    /**
     * @Route("/providers/create/", name="agrigestion_admin_provider_create")
     * @Route("/providers/edit/{id}", name="agrigestion_admin_provider_edit")
     * @Route("/providers/show/{id}", name="agrigestion_admin_provider_show")
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $disabled_form = $request->get("_route") === "agrigestion_admin_provider_show" ? true : false;

        if ($id === null) {
            $provider = new Provider();
        } else {
            $provider = $em->getRepository(Provider::class)->find($id);
        }

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\Provider::class, $provider, ["disabled" => $disabled_form]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "Le fournisseur ". $provider->getName() . " a été créé");
            } else {
                $this->addFlash("success-flash", "Le fournisseur ". $provider->getName() . " a été édité");
            }

            return $this->redirectToRoute("agrigestion_admin_provider_index");
        }

        return $this->render("@AgriGestion/admin/providers/edit.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "provider" => $provider,
            "disabled_form" => $disabled_form
        ]);
    }

    /**
     * @Route("/providers/delete/{id}", name="agrigestion_admin_provider_delete")
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $provider = $em->getRepository(Provider::class)->find($id);

        if ($provider) {
            $provider->setDeleted(true);
            $em->persist($provider);
            $em->flush();

            $this->addFlash("success-flash", "Le fournisseur ". $provider->getName() . " a été supprimé");
        }

        return $this->redirectToRoute("agrigestion_admin_provider_index");
    }

    /**
     * @Route("/providers/address/create/{provider_id}", name="agrigestion_admin_provider_address_create")
     * @Route("/providers/address/edit/{provider_id}/{id}", name="agrigestion_admin_provider_address_edit")
     * @Route("/providers/address/show/{provider_id}/{id}", name="agrigestion_admin_provider_address_show")
     * @param Request $request
     * @param int|null $provider_id
     * @param int|null $id
     * @return Response
     */
    public function editAddress(Request $request, int $provider_id = null, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $disabled_form = $request->get("_route") === "agrigestion_admin_provider_address_show" ? true : false;

        $provider = $em->getRepository(Provider::class)->find($provider_id);

        if ($id === null) {
            $provider_address = new ProviderAddress();
        } else {
            $provider_address = $em->getRepository(ProviderAddress::class)->find($id);
        }

        $provider_address->setProvider($provider);

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\ProviderAddress::class, $provider_address, ["disabled" => $disabled_form]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setProvider($provider);
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "L'adresse ". $provider_address->getName() . " a été créé");
            } else {
                $this->addFlash("success-flash", "L'adresse ". $provider_address->getName() . " a été édité");
            }

            return $this->redirectToRoute("agrigestion_admin_provider_edit", ["id" => $provider_id]);
        }

        return $this->render("@AgriGestion/admin/providers/edit-address.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "provider_address" => $provider_address,
            "disabled_form" => $disabled_form
        ]);
    }

    /**
     * @Route("/providers/contact/create/{provider_id}", name="agrigestion_admin_provider_contact_create")
     * @Route("/providers/contact/edit/{provider_id}/{id}", name="agrigestion_admin_provider_contact_edit")
     * @Route("/providers/contact/show/{provider_id}/{id}", name="agrigestion_admin_provider_contact_show")
     * @param Request $request
     * @param int|null $provider_id
     * @param int|null $id
     * @return Response
     */
    public function editContact(Request $request, int $provider_id = null, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $disabled_form = $request->get("_route") === "agrigestion_admin_provider_contact_show" ? true : false;

        $provider = $em->getRepository(Provider::class)->find($provider_id);

        if ($id === null) {
            $provider_contact = new ProviderContact();
        } else {
            $provider_contact = $em->getRepository(ProviderContact::class)->find($id);
        }

        $provider_contact->setProvider($provider);

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\ProviderContact::class, $provider_contact, ["provider" => $provider, "disabled" => $disabled_form]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setProvider($provider);
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "L'adresse ". $provider_contact->getTitle() . " a été créé");
            } else {
                $this->addFlash("success-flash", "L'adresse ". $provider_contact->getTitle() . " a été édité");
            }

            return $this->redirectToRoute("agrigestion_admin_provider_edit", ["id" => $provider_id]);
        }

        return $this->render("@AgriGestion/admin/providers/edit-contact.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "provider_contact" => $provider_contact,
            "disabled_form" => $disabled_form
        ]);
    }
}
