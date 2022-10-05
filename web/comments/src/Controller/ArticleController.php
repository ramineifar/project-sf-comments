<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="show_article", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function index(Article $article, Request $request, EntityManagerInterface $manager): Response
    {
        $comment = new Comment();
        $comment->setArticle($article);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('show_article', ['id' => $article->getId()]);
        }

        return $this->render('pages/article.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
}
