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
        $infos = $session->get("jwt_infos");
        $type = $infos->type ?? null;
        $parcels = $em->getRepository(Parcel::class)->findByOldEndDate($type);

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
     * @Route("/parcels/edit", name="agriparcel_api_admin_parcel_edit", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     * @throws Exception
     */
    public function edit(EntityManagerInterface $em, SessionInterface $session, Api $api): JsonResponse
    {
        $infos = $session->get("jwt_infos");

        $parcel = $em->getRepository(Parcel::class)->findOneBy([
            "name" => $infos->name,
        ]);

        if ($parcel && $infos->id && $parcel->getId() !== $infos->id) {
            return new JsonResponse([
                "success" => false,
                "error_message" => "Cette parcelle existe déjà",
                "token" => $session->get("account_token")->getToken()
            ]);
        }

        if ($infos->id) {
            $parcel = $em->getRepository(Parcel::class)->find($infos->id);
        } else {
            $parcel = new Parcel();
        }

        $parcel->setName($infos->name);
        $parcel->setType($infos->type);
        $parcel->setSurface($infos->surface);
        $em->persist($parcel);
        $em->flush();

        return new JsonResponse([
            "success" => true,
            "success_message" => "La parcelle : " .$parcel->getName()." ". ($infos->id ? "a été éditée" : "a été créée"),
            "token" => $session->get("account_token")->getToken()
        ]);
    }

    /**
     * @Route("/parcels/show", name="agriparcel_api_admin_parcel_show", methods={"POST"})
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @param Api $api
     * @return JsonResponse
     */
    public function show(EntityManagerInterface $em, SessionInterface $session, Api $api)
    {
        $infos = $session->get("jwt_infos");

        $parcel = $em->getRepository(Parcel::class)->find((int)$infos->id);

        if ($parcel) {
            return new JsonResponse([
                "success" => true,
                "parcel" => $api->serializeObject($parcel),
                "token" => $session->get("account_token")->getToken()
            ]);
        }

        return new JsonResponse([
            "success" => false,
            "error_message" => "La parcelle demandée n'existe plus",
            "token" => $session->get("account_token")->getToken()
        ]);
    }
}
