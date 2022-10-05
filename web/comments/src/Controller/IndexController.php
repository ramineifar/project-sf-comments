<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="liste_articles", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
        $articles = $articleRepository->getLastCommitedArticles();

        return $this->render('pages/index.html.twig', [
            'articles' => $articles,
            'brouillon' => false
        ]);
    }
}
