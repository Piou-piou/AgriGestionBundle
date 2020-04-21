<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PiouPiou\AgriGestionBundle\Entity\CowsInParcel;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
use PiouPiou\RibsAdminBundle\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CowsApiController extends AbstractController
{

    /**
     * @Route("/api/cows/list", name="agriparcel_api_admin_cows_list", methods={"POST"})
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

    /**
     * @Route("/api/cows/add", name="agriparcel_api_admin_cows_add", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function add(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");
        $start_date = DateTime::createFromFormat("Y-m-d", explode("T", $infos->start_date)[0]);
        $end_date = $infos->end_date ? DateTime::createFromFormat("Y-m-d", explode("T", $infos->end_date)[0]) : null;
        $parcel = $em->getRepository(Parcel::class)->findOneBy(["id" => $infos->parcel_id]);

        $cows_in_Parcel = new CowsInParcel();
        $cows_in_Parcel->setCowNumber($infos->cows_number);
        $cows_in_Parcel->setStartDate($start_date);
        $cows_in_Parcel->setEndDate($end_date);
        $cows_in_Parcel->setParcel($parcel);
        $em->persist($cows_in_Parcel);
        $em->flush();

        return new JsonResponse([
            "success" => true,
            "success_message" => "Les vaches ont été ajoutées à la parcelle " .$parcel->getName(),
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}