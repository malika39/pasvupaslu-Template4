<?php

namespace App\Controller\Admin;

use App\Entity\InterView;
use App\Entity\ImageAdmin;
use App\Form\InterViewType;
use App\Services\Uploader;
use App\Services\Slugger;
use App\Repository\InterViewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterViewController extends AbstractController
{

    /**
     * @Route("/admin/interViews", name="admin-interViews", methods={"GET"})
     */
    public function listInterView(InterViewRepository $interViews): Response
    {
        return $this->render('admin/interViews/list.html.twig', [
            'interViews' => $interViews->findAll(),
        ]);
    }
    /**
     * @Route("admin/interView/{slug}/edit", name="interView_edit", methods={"GET", "POST"})
     */
    public function editor(Request $req, $id, Slugger $slugger,Uploader $file)
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
            $interView->addImage(new ImageAdmin());



        }

        $form = $this->createForm(InterViewType::class, $interView);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($interView->getImagesAdmin() as $image) {
                if ($file = $image->getFie()) {
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $image->setName($filename);
                    $file->move($this->getParameter('imagesAdmin_directory'), $filename);
                }

            }

            $slug = $slugger->slugify($interView);
            $interView->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($interView);
            $em->flush();

            $this->addFlash('success', 'InterView ajouté');

            return $this->redirect($this->generateUrl('interView_edit', [
                'id' => $interView->getId(),
            ]));
        }

        return $this->render('admin/interView_editor.html.twig', [
            'form' => $form->createView(),
            'title' => $title,
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


}
