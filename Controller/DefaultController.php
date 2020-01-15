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
        return new Response();
    }
}
