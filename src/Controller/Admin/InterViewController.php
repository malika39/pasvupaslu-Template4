<?php

namespace App\Controller\Admin;

use App\Controller\HelperTrait;
use App\Entity\InterView;
use App\Entity\ImageAdmin;
use App\Entity\Question;
use App\Form\InterViewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class InterViewController extends AbstractController
{
    use HelperTrait;

    /**
     * @Route("/admin/interViews", name="admin-interViews", methods={"GET"})
     */
    public function listInterView(Request $req)

    {
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            ->getForm();

        $form->handleRequest($req);

        $maxResults = 10;
        $firstResult = 1;

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->getData();

            $interViews = $this->getDoctrine()
                ->getRepository(InterView::class)
                ->search($query['search'], $firstResult, $maxResults);
        } else {
            $interViews = $this->getDoctrine()
                ->getRepository(InterView::class);
        }
        return $this->render('admin/pages/interViews.html.twig', [
            'interViews' => $interViews,
            'form' => $form->createView(),
        ]);
    }

    public function editor(Request $req, $id)
    {
        $interView = new InterView();

        $title = 'Nouveau InterView';

        if ($id) {
            $interView = $this->getDoctrine()
                ->getRepository(InterView::class)
                ->find($id);

            if (!$interView) {
                throw $this->createNotFoundException('Ce interView n\'existe pas');
            }

            $title = 'Modification d\'un interView';
        } else {
            $interView->addImageFile(new ImageAdmin());
            $interView->addQuestions(new Question());

        }

        $form = $this->createForm(InterViewType::class, $interView);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($interView->getImagesAdmin() as $image) {
                if ($file = $image->getFile()) {
                    $filename = $this->slugify($interView->getName()).'-'.$image->getAlt().'.'.'jpg';
                    $image->setAlt($filename);
                    $file->move($this->getParameter('imagesAdmin_directory'), $filename);
                }
                $interView->addImageFile($image);
            }

            foreach ($interView->getQuestions() as $questions) {
                {
                         if(!$questions){
                             $questions =$this->getDoctrine()->getManager();
                         }


                }

                $interView->addQuestions($questions);
            }
            $slug = $this->slugify($interView->getName());
            $interView->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($interView);
            $em->flush();

            $this->addFlash('success', 'InterView ajouté');

            return $this->redirect($this->generateUrl('admin-interView-edit', [
                'id' => $interView->getId(),

            ]));
        }
        dump($interView);
        return $this->render('admin/pages/addinterview.html.twig', [
            'form' => $form->createView(),
            'title' => $title,
            'interView' => $interView,
        ]);

    }

    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        $interView = $em->getRepository(InterView::class)->find($id);
        $interView->setDeletedAt(new \Datetime());

        $em->persist($interView);
        $em->flush();

        $this->addFlash('success', 'InterView supprimé');

        return $this->redirectToRoute('admin-home');
    }

    /**
     * @Route("/interView/{id}", name="interView-show", methods={"GET"})
     */
    public function showI(InterView $interView)
    {
        return $this->render('pages/interview-view.html.twig', [
            'interView' => $interView,
        ]);
    }

}
