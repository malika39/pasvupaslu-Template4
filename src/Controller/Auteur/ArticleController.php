<?php

namespace App\Controller\Auteur;

use App\Entity\Article;
use App\Entity\Livres;
use App\Form\ArticleType;
use App\Form\LivreFormType;
use App\Services\Article\Manager\LivresManager;
use App\Services\FlashMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

class ArticleController extends AbstractController
{
    /**
     * @var LivresManager
     */
    private $articleManager;

    /**
     * @var TranslatorInterface
     */
    private $trans;

    public function __construct(LivresManager $articleManager, TranslatorInterface $trans)
    {
        $this->articleManager = $articleManager;
        $this->trans = $trans;
    }

    /**
     * @Route("auteur/article/new", name="article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FlashMessage $flashMessage): Response
    {
        $article = new Livres();
        $form = $this->createForm(LivreFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->articleManager->create($article);
            $flashMessage->createMessage(
                $request,
                FlashMessage::INFO_MESSAGE,
                $this->trans->trans('auteur.articles.flashmessage_publish'));

            return $this->redirectToRoute('auteur-articles');
        }

        return $this->render('pages/article/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("auteur/article/{slug}/edit", name="article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Livres $article, FlashMessage $flashMessage): Response
    {
        $image = $article->getPhoto();
        $form = $this->createForm(LivreFormType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->articleManager->edit($article);

            $flashMessage->createMessage(
                    $request,
                    FlashMessage::INFO_MESSAGE,
                    $this->trans->trans('backoffice.articles.flashmessage_edit')
                );

            return $this->redirect($request->getUri());
        }

        return $this->render('pages/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'currentImage' => $image,
        ]);
    }

    /**
     * @Route("auteur/article/{slug}/delete", name="article_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Livres $article, FlashMessage $flashMessage): Response
    {
        $this->articleManager->remove($article);

        $flashMessage->createMessage(
            $request,
            FlashMessage::INFO_MESSAGE,
            $this->trans->trans('backoffice.articles.flashmessage_deleted_article')
        );

        return $this->redirectToRoute('auteur-articles');
    }
}
