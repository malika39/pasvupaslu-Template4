<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\EditeurRepository;
use App\Repository\InterViewRepository;
use App\Services\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * @Cache(smaxage="5")
     */
    public function index(Paginator $paginator, ArticleRepository $articleRepository,EditeurRepository $editeurRepository,InterViewRepository $interViewRepository): Response
    {
        $page = $paginator->getPage();
        $articles = $paginator->getItemList($articleRepository, $page);
        $editeurs = $paginator->getItemList($editeurRepository, $page);
        $interViews = $paginator->getItemList($interViewRepository, $page);
        $nbPages = $paginator->countPage($articles);

        return $this->render('pages/index.html.twig', [
            'articles' => $articles,
            'editeurs' => $editeurs,
            'interViews' => $interViews,
            'nbPages' => $nbPages,
            'page' => $page,
        ]);
    }

    /**
     * @Route("article/{slug}", name="article_show", methods={"GET", "POST"})
     */
    public function show(Article $article): Response
    {
        return $this->render('pages/books.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("article/{slug}/comment/new", name="comment_new", methods={"POST"})
     */
    public function newComment(Request $request, Article $article): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $article->addComment($comment);
            $user->addComment($comment);

            $em->persist($comment);
            $em->flush();
        }

        return $this->redirectToRoute('article_show', ['slug' => $article->getSlug()]);
    }

    /**
     * @ParamConverter()
     */
    public function commentForm(Article $article): Response
    {
        $form = $this->createForm(CommentType::class);

        return $this->render('blog/article/_comment_form.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }


}
