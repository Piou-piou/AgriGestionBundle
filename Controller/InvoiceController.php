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

        return $this->render("@AgriGestion/admin/invoices/index.html.twig", [
            "invoices" => $invoices,
            "searches" => $this->getSearches()
        ]);
    }
}
