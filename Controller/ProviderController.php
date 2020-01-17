<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use PiouPiou\AgriGestionBundle\Entity\Provider;
use PiouPiou\AgriGestionBundle\Entity\ProviderAdress;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    /**
     * @Route("/providers/list/", name="agrigestion_admin_provider_index")
     * @return Response
     */
    public function index(): Response
    {
        $providers = $this->getDoctrine()->getRepository(Provider::class)->findAll();

        return $this->render("@AgriGestion/admin/providers/index.html.twig", ["providers" => $providers]);
    }

    /**
     * @Route("/providers/create/", name="agrigestion_admin_provider_create")
     * @Route("/providers/edit/{id}", name="agrigestion_admin_provider_edit")
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        if ($id === null) {
            $provider = new Provider();
        } else {
            $provider = $em->getRepository(Provider::class)->find($id);
        }

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\Provider::class, $provider);

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
            "provider" => $provider
        ]);
    }

    /**
     * @Route("/providers/create/{provider_id}", name="agrigestion_admin_provider_address_create")
     * @Route("/providers/edit/{provider_id}/{id}", name="agrigestion_admin_provider_address_edit")
     * @param Request $request
     * @param int|null $provider_id
     * @param int|null $id
     * @return Response
     */
    public function editAddress(Request $request, int $provider_id = null, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        $provider = $em->getRepository(Provider::class)->find($provider_id);

        if ($id === null) {
            $provider_address = new ProviderAdress();
        } else {
            $provider_address = $em->getRepository(ProviderAdress::class)->find($id);
        }

        $provider_address->setProvider($provider);

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\ProviderAddress::class, $provider_address);

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
        ]);
    }
}
