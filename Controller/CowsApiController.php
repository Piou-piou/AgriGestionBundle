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
        $cows_in_parcels = $em->getRepository(CowsInParcel::class)->findBy(["end_date" => null]);

        return new JsonResponse([
            "success" => true,
            "cows_in_parcel" => $api->serializeObject($cows_in_parcels),
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/api/cows/list-types", name="agriparcel_api_admin_cows_list_types", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function list(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        return new JsonResponse([
            "success" => true,
            "types" => CowsInParcel::TYPE,
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/api/cows/add", name="agriparcel_api_admin_cows_add", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function add(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");
        $start_date = DateTime::createFromFormat("Y-m-d", explode("T", $infos->start_date)[0]);
        $end_date = $infos->end_date ? DateTime::createFromFormat("Y-m-d", explode("T", $infos->end_date)[0]) : null;
        $parcel = $em->getRepository(Parcel::class)->findOneBy(["id" => $infos->parcel_id]);

        $cows_exist = $em->getRepository(CowsInParcel::class)->findOneBy([
            "cow_number" => $infos->cows_number,
            "end_date" => null
        ]);

        if ($cows_exist) {
            $cows_exist->setEndDate(new DateTime());
            $em->persist($cows_exist);
            $em->flush();
        }

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

    /**
     * @Route("/api/cows/exit", name="agriparcel_api_admin_cows_exit", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function exitCows(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");
        $cows_in_Parcel = $em->getRepository(CowsInParcel::class)->find($infos->id);

        if ($cows_in_Parcel) {
            $cows_in_Parcel->setEndDate(new DateTime());
            $em->persist($cows_in_Parcel);
            $em->flush();
            $cows_in_parcels = $em->getRepository(CowsInParcel::class)->findBy(["end_date" => null]);

            return new JsonResponse([
                "success" => true,
                "success_message" => "Les vaches ont été sorties de la parcelle " . $cows_in_Parcel->getParcel()->getName(),
                "cows_in_parcel" => $api->serializeObject($cows_in_parcels),
                "token" => $session->get("account_token")->getToken()
            ]);
        }

        return new JsonResponse([
            "success" => false,
            "error_message" => "Parcelle inexistante, merci de réessayer",
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
