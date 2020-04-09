<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/index/", name="agrigestion_admin_index")
     * @return Response
     */
    public function index():Response
    {
        return $this->render("@AgriGestion/admin/management/index.html.twig");
    }

    /**
     * @Route("/index-parcel/", name="agriparcel_admin_index")
     * @return Response
     */
    public function indexParcel():Response
    {
        return $this->render("@AgriGestion/admin/parcel/index.html.twig");
    }
}
