<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
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
    public function indexParcel(EntityManagerInterface $em):Response
    {
        $parcels = $em->getRepository(Parcel::class)->findByOldEndDate();
        dump($parcels);

        return $this->render("@AgriGestion/admin/parcel/index.html.twig");
    }
}
