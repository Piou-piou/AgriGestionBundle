<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use PiouPiou\AgriGestionBundle\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    /**
     * @Route("/providers/list/", name="agrigestion_admin_provider_index")
     * @return Response
     */
    public function index():Response
    {
        $providers = $this->getDoctrine()->getRepository(Provider::class)->findAll();

        return $this->render("@AgriGestion/admin/providers/index.html.twig", ["providers" => $providers]);
    }

    /**
     * @Route("/providers/create/", name="agrigestion_admin_provider_create")
     * @Route("/providers/edit/", name="agrigestion_admin_provider_edit")
     * @return Response
     */
    public function edit():Response
    {
        return $this->render("@AgriGestion/admin/providers/index.html.twig");
    }
}
