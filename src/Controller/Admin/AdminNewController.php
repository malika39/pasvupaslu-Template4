<?php

namespace App\Controller\Admin;


use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Repository\EditeurRepository;
use App\Repository\InterViewRepository;
use App\Repository\UserRepository;
use App\Services\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewController extends AbstractController
{

    /**
     * @Route("/admin/articles", name="admin-articles", methods={"GET"})
     */
    public function listArticle(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin/pages/index.html.twig', [
            'articles' => $articleRepository->getArticlesWithComment(),
        ]);
    }

    /**
     * @Route("/admin/dashboard", name="admin-home", methods={"GET"})
     *
     */
    public function index( CommentRepository $comments,ArticleRepository $articles, UserRepository $users, EditeurRepository $editeurs,InterViewRepository $interViews): Response
    {


        return $this->render('admin/pages/index.html.twig', [

            'countEditeurs' => $editeurs->countEditeurs(),
            'countInterViews' => $interViews->countInterViews(),
            'countComments' => $comments->countComments(),
            'countUsers' => $users->countUsers(),
            'countArticles' => $articles->countArticles(),
        ]);
    }
}
