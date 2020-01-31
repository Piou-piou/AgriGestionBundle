<?php

namespace PiouPiou\AgriGestionBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PiouPiou\AgriGestionBundle\Entity\Article;
use PiouPiou\AgriGestionBundle\Entity\ArticlePrice;
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
        $em = $this->getDoctrine()->getManager();

        if ($id === null) {
            $article = new Article();
        } else {
            $article = $em->getRepository(Article::class)->find($id);
        }

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\Article::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "L'article ". $article->getName() . " a été créé");
            } else {
                $this->addFlash("success-flash", "L'article ". $article->getName() . " a été édité");
            }

            return $this->redirectToRoute("agrigestion_admin_article_index");
        }

        return $this->render("@AgriGestion/admin/articles/edit.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "article" => $article
        ]);
    }

    /**
     * @Route("/articles/price/create/{article_id}", name="agrigestion_admin_article_price_create")
     * @Route("/articles/price/edit/{article_id}/{id}", name="agrigestion_admin_article_price_edit")
     * @param Request $request
     * @param int $article_id
     * @param int|null $id
     * @return Response
     */
    public function editPrice(Request $request, int $article_id, int $id = null): Response
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository(Article::class)->find($article_id);

        /** @var ArticlePrice $article_price */
        if ($id === null) {
            $article_price = new ArticlePrice();
        } else {
            $article_price = $em->getRepository(ArticlePrice::class)->find($id);
        }

        $article_price->setArticle($article);

        $form = $this->createForm(\PiouPiou\AgriGestionBundle\Form\ArticlePrice::class, $article_price);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data->setArticle($article);
            $em->persist($data);
            $em->flush();

            if ($id === null) {
                $this->addFlash("success-flash", "Le prix ". $article_price->getReference() . " a été créé");
            } else {
                $this->addFlash("success-flash", "Le prix ". $article_price->getReference() . " a été édité");
            }

            return $this->redirectToRoute("agrigestion_admin_article_edit", ["id" => $article_id]);
        }

        return $this->render("@AgriGestion/admin/articles/edit-price.html.twig", [
            "form" => $form->createView(),
            "form_errors" => $form->getErrors(),
            "article" => $article,
            "article_price" => $article_price,
        ]);
    }
}
