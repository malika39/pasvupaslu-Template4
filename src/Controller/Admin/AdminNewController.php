<?php

namespace App\Controller\Admin;


use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\EditeurRepository;
use App\Repository\InterViewRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin-home", methods={"GET"})
     */
    public function dashBoard(ArticleRepository $article, CommentRepository $comment, UserRepository $user,EditeurRepository $editeur,InterViewRepository $interView): Response
    {
        return $this->render('admin/pages/index.html.twig', [
            'countArticles' => $article->countArticles(),
            'countEditeurs' => $editeur->countEditeurs(),
            'countInterViews' => $interView->countInterViews(),
            'countComments' => $comment->countComments(),
            'countUsers' => $user->countUsers(),
        ]);
    }

    /**
     * @Route("/admin/articles", name="admin-articles", methods={"GET"})
     */
    public function listArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin/pages/index.html.twig', [
            'articles' => $articleRepository->getArticlesWithComment(),
        ]);
    }
}
