<?php

namespace App\Controller\Auteur;

use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur/dashboard", name="auteur-dashboard", methods={"GET"})
     */
    public function dashBoard(ArticleRepository $article, CommentRepository $comment): Response
    {
        return $this->render('auteur/dashboard/dashboard.html.twig', [
            'countArticles' => $article->countArticles(),
            'countComments' => $comment->countComments(),

        ]);
    }

    /**
     * @Route("/auteur/articles", name="auteur-articles", methods={"GET"})
     */
    public function listArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('pages/article/list.html.twig', [
            'articles' => $articleRepository->getArticlesWithComment(),
        ]);
    }
}
