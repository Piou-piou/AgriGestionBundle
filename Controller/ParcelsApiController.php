<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PiouPiou\AgriGestionBundle\Entity\CowsInParcel;
use PiouPiou\RibsAdminBundle\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParcelsApiController extends AbstractController
{
    /**
     * @Route("/api/parcels/list", name="agriparcel_api_admin_parcel_index")
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function index(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $cows_in_parcels = $em->getRepository(CowsInParcel::class)->findAll();

        return new JsonResponse([
            "success" => true,
            "cows_in_parcel" => $api->serializeObject($cows_in_parcels),
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
