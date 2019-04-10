<?php

namespace App\Controller\Admin;


use App\Repository\LivresRepositoryRepository;
use App\Repository\CommentRepository;
use App\Repository\EditeurRepository;
use App\Repository\InterViewRepository;
use App\Repository\LivresRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/dashboard", name="admin-home", methods={"GET"})
     * @param LivresRepository $article
     * @param CommentRepository $comment
     * @param UserRepository $user
     * @param EditeurRepository $editeur
     * @return Response
     */
    public function dashBoard(LivresRepository $article, CommentRepository $comment, UserRepository $user,EditeurRepository $editeur): Response
    {
        return $this->render('admin/pages/index.html.twig', [
            'countArticles' => $article->countArticles(),
            'countEditeurs' => $editeur->countEditeurs(),
          /**  'countInterViews' => $interView->countInterViews(),**/
            'countComments' => $comment->countComments(),
            'countUsers' => $user->countUsers(),
        ]);
    }

    /**
     * @Route("/admin/articles", name="admin-articles", methods={"GET"})
     */
    public function listArticle(LivresRepository $articleRepository): Response
    {
        return $this->render('admin/pages/index.html.twig', [
//            'articles' => $articleRepository->getArticlesWithComment(),
        ]);
    }

}
