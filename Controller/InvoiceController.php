<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\MappingException;
use PiouPiou\AgriGestionBundle\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    use SearchEngineTrait;

    /**
     * @Route("/invoices/list/", name="agrigestion_admin_invoice_index")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @throws MappingException
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $invoices = $this->doSearch($em, $request->get("search") ?? [], Invoice::class);

        return $this->render("@AgriGestion/admin/management/invoices/index.html.twig", [
            "invoices" => $invoices,
            "searches" => $this->getSearches()
        ]);
    }

    /**
     * @Route("/invoices/create/", name="agrigestion_admin_invoice_create")
     * @Route("/invoices/edit/{id}", name="agrigestion_admin_invoice_edit")
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        if ($id === null) {
            $invoice = new Invoice();
        } else {
            $invoice = $em->getRepository(Invoice::class)->find($id);
        }

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\Invoice::class, $invoice);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "La facture ". $invoice->getName() . " a été créée");
            } else {

                $this->addFlash("success-flash", "La facture ". $invoice->getName() . " a été éditée");
            }

            return $this->redirectToRoute("agrigestion_admin_article_index");
        }

        return $this->render("@AgriGestion/admin/management/invoices/edit.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "invoice" => $invoice,
            "disabled_form" => false
        ]);
    }
}
