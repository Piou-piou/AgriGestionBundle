<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProviderController extends AbstractController
{
    /**
     * @Route("/providers/list", name="agrigestion_admin_provider_index")
     * @return Response
     */
    public function index():Response
    {
        return $this->render("@AgriGestion/admin/providers/index.html.twig");
    }

    /**
     * @Route("/providers/create", name="agrigestion_admin_provider_create")
     * @return Response
     */
    public function edit():Response
    {
        return $this->render("@AgriGestion/admin/providers/index.html.twig");
    }
}
