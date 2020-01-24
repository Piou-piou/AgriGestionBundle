<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PiouPiou\AgriGestionBundle\Entity\Article;
use PiouPiou\AgriGestionBundle\Entity\Provider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    use SearchEngineTrait;

    /**
     * @Route("/articles/list/", name="agrigestion_admin_article_index")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $articles = $this->doSearch($em, $request->get("search") ?? [], Article::class);

        return $this->render("@AgriGestion/admin/articles/index.html.twig", [
            "articles" => $articles,
            "searches" => $this->getSearches()
        ]);
    }

    /**
     * @Route("/articles/create/", name="agrigestion_admin_article_create")
     * @Route("/articles/edit/{id}", name="agrigestion_admin_article_edit")
     * @param Request $request
     * @param int|null $id
     * @return Response
     */
    public function edit(Request $request, int $id = null): Response
    {
        return new Response();
    }
}
