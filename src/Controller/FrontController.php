<?php

namespace App\Controller;


use App\Entity\Editeur;
use App\Entity\InterView;
use App\Entity\Question;
use App\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{


    /**
     * @Route("editeur/{slug}", name="editeur_show", methods={"GET", "POST"})
     */
    public function showE(Editeur $editeur): Response
    {
        return $this->render('front/editeur/show.html.twig', [
            'editeur' => $editeur,
        ]);
    }
    /**
     * @Route("/admin/editeur/{slug}/question/new", name="questionE_new", methods={"POST"})
     */
    public function newQuestionE(Request $request, Editeur $editeur): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $editeur->addQuestions($question);


            $em->persist($question);
            $em->flush();
        } return $this->redirectToRoute('editeur_show', ['slug' => $editeur->getSlug()]);
    }

    /**
     * @ParamConverter()
     */
    public function questioneForm(Editeur $editeur): Response
    {
        $form = $this->createForm(QuestionType::class);

        return $this->render('admin/editeur/_question_form.html.twig', [
            'form' => $form->createView(),
            'editeur' => $editeur,
        ]);
    }


    /**
     * @Route("interView/{slug}", name="interView_show", methods={"GET", "POST"})
     */
    public function showI(Editeur $interView): Response
    {
        return $this->render('admin/interView/show.html.twig', [
            'interView' => $interView,
        ]);
    }
    /**
     * @Route("/admin/interView/{slug}/question/new", name="questionI_new", methods={"POST"})
     */
    public function newQuestionI(Request $request, Editeur $interView): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $interView->addQuestions($question);


            $em->persist($question);
            $em->flush();
        } return $this->redirectToRoute('interView_show', ['slug' => $interView->getSlug()]);
    }

    /**
     * @ParamConverter()
     */
    public function questioniForm(Editeur $interView): Response
    {
        $form = $this->createForm(QuestionType::class);

        return $this->render('admin/interView/_question_form.html.twig', [
            'form' => $form->createView(),
            'interView' => $interView,
        ]);
    }

}
