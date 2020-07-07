<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
use PiouPiou\RibsAdminBundle\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ParcelsApiController extends AbstractController
{
    /**
     * @Route("/parcels/list", name="agriparcel_api_admin_parcel_list", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function list(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $parcels = $em->getRepository(Parcel::class)->findByOldEndDate();

        return new JsonResponse([
            "success" => true,
            "parcels" => $parcels,
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/parcels/list-types", name="agriparcel_api_admin_parcel_list_types", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function listTypes(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        return new JsonResponse([
            "success" => true,
            "types" => Parcel::TYPES,
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/parcels/add", name="agriparcel_api_admin_parcel_add", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function add(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");

        $parcel = $em->getRepository(Parcel::class)->findOneBy([
            "name" => $infos->name,
        ]);

        if ($parcel) {
            return new JsonResponse([
                "success" => false,
                "error_message" => "Cette parcelle existe déjà",
                "token" => $session->get("account_token")->getToken()
            ]);
        }

        $parcel = new Parcel();
        $parcel->setName($infos->name);
        $parcel->setType($infos->type);
        $parcel->setSurface($infos->surface);
        $em->persist($parcel);
        $em->flush();

        return new JsonResponse([
            "success" => true,
            "success_message" => "La parcelle : " .$parcel->getName()." a été créée",
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
