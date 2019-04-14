<?php

namespace App\Controller\Admin;


use App\Entity\Editeur;
use App\Entity\ImageAdmin;
use App\Entity\InterView;
use App\Entity\Question;
use App\Form\ImageAdminType;
use App\Form\QuestionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{


    /**
     * @Route("/interView/{id}", name="interView-show", methods={"GET", "POST"})
     */
    public function showI(InterView $interView): Response
    {
        return $this->render('pages/interview-view.html.twig', [
            'interView' => $interView,
        ]);
    }


}
