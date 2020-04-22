<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
use PiouPiou\RibsAdminBundle\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParcelsApiController extends AbstractController
{
    /**
     * @Route("/api/parcels/list", name="agriparcel_api_admin_parcel_list", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function list(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $parcels = $em->getRepository(Parcel::class)->findByOldEndDate();

        return new JsonResponse([
            "success" => true,
            "parcels" => $api->serializeObject($parcels),
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
