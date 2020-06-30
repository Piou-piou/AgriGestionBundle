<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PiouPiou\AgriGestionBundle\Entity\CowsInParcel;
use PiouPiou\AgriGestionBundle\Entity\HayTracking;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
use PiouPiou\RibsAdminBundle\Service\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HaystacksApiController extends AbstractController
{

    /**
     * @Route("/haystacks/list", name="agriparcel_api_admin_haystack_list", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function index(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $haystack_in_parcels = $em->getRepository(CowsInParcel::class)->findBy(["end_date" => null]);

        return new JsonResponse([
            "success" => true,
            "haystack_in_parcel" => $api->serializeObject($haystack_in_parcels),
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/haystacks/list-types", name="agriparcel_api_admin_haystack_list_types", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function list(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        return new JsonResponse([
            "success" => true,
            "types" => HayTracking::TYPE,
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/haystacks/add", name="agriparcel_api_admin_haystack_add", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function add(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");
        $parcel = $em->getRepository(Parcel::class)->findOneBy(["id" => $infos->parcel_id]);

        $haystack_exist = $em->getRepository(HayTracking::class)->findOneBy([
            "haystack_number" => $infos->haystack_number,
            "type" => $infos->type,
            "year" => date(("Y"))
        ]);

        if ($haystack_exist) {
            return new JsonResponse([
                "success" => false,
                "error_message" => "Cette parcelle a déjà été remplie pour ce type.",
                "token" => $session->get("account_token")->getToken()
            ]);
        }

        $hay_tracking = new HayTracking();
        $hay_tracking->setHaystackNumber($infos->haystack_number);
        $hay_tracking->setType($infos->type);
        $hay_tracking->setYear(date("Y"));
        $hay_tracking->setParcel($parcel);
        $em->persist($hay_tracking);
        $em->flush();

        return new JsonResponse([
            "success" => true,
            "success_message" => "Les bottes ont été ajoutées à la parcelle " .$parcel->getName(),
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
