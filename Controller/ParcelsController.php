<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\MappingException;
use PiouPiou\AgriGestionBundle\Entity\Article;
use PiouPiou\AgriGestionBundle\Entity\Parcel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcelsController extends AbstractController
{
    use SearchEngineTrait;

    /**
     * @Route("/parcels/list/", name="agriparcel_admin_parcel_index")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws MappingException
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $parcels = $this->doSearch($em, $request->get("search") ?? [], Parcel::class);

        return $this->render("@AgriGestion/admin/parcel/parcels/index.html.twig", [
            "parcels" => $parcels,
            "searches" => $this->getSearches()
        ]);
    }

    /**
     * @Route("/parcels/create/", name="agriparcel_admin_parcel_create")
     * @Route("/parcels/edit/{id}", name="agriparcel_admin_parcel_edit")
     * @Route("/parcels/show/{id}", name="agriparcel_admin_parcel_show")
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $disabled_form = $request->get("_route") === "agriparcel_admin_parcel_show" ? true : false;

        if ($id === null) {
            $parcel = new Parcel();
        } else {
            $parcel = $em->getRepository(Parcel::class)->find($id);
        }

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\Parcel::class, $parcel, [
            "disabled" => $disabled_form,
            "em" => $em
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "La parcelle ". $parcel->getName() . " a été créé");
            } else {
                $this->addFlash("success-flash", "La parcelle ". $parcel->getName() . " a été édité");
            }

            return $this->redirectToRoute("agriparcel_admin_parcel_index");
        }

        return $this->render("@AgriGestion/admin/parcel/parcels/edit.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "parcel" => $parcel,
            "disabled_form" => $disabled_form
        ]);
    }
}
