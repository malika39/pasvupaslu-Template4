<?php

namespace App\Controller\Admin;

use App\Entity\Editeur;
use App\Entity\InterView;
use App\Entity\ImageAdmin;
use App\Form\InterViewType;
use App\Services\Uploader;
use App\Services\Slugger;
use App\Repository\InterViewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InterViewController extends AbstractController
{

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

            return $this->redirect($this->generateUrl('admin_interView_edit', [
                'id' => $interView->getId(),
            ]));
        }

        return $this->render('admin/pages/addinterview.html.twig', [
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
