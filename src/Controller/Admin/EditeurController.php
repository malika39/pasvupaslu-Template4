<?php

namespace App\Controller\Admin;

use App\Entity\Editeur;
use App\Form\EditeurType;
use App\Services\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EditeurController extends AbstractController
{

    /**
     * @Route("/admin/editeurs", name="admin-editeurs", methods={"GET"})
     */
    public function listEditeur(Request $req)
    {
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            ->getForm();

        $form->handleRequest($req);

        $maxResults = 10;
        $firstResult = 1;

        if ($form->isSubmitted() && $form->isValid()) {
            $query = $form->getData();

            $editeurs = $this->getDoctrine()
                ->getRepository(Editeur::class)
                ->search($query['search'], $firstResult, $maxResults);
        } else {
            $editeurs = $this->getDoctrine()
                ->getRepository(Editeur::class);

        }
        return $this->render('admin/pages/listeditor.html.twig', [
            'editeurs' => $editeurs,
            'form' => $form->createView(),

        ]);
    }

    public function editor(Request $req, $id, Slugger $slugger)
    {
        $editeur = new Editeur();

        $title = 'Nouveau Editeur';

        if ($id) {
            $editeur = $this->getDoctrine()
                ->getRepository(Editeur::class)
                ->find($id);

            if (!$editeur) {
                throw $this->createNotFoundException('Ce editeur n\'existe pas');
            }

            $title = 'Modification d\'un editeur';
        }

        $form = $this->createForm(EditeurType::class, $editeur);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {


            $slug = $slugger->slugify($editeur);
            $editeur->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($editeur);
            $em->flush();

            $this->addFlash('success', 'Editeur ajouté');

            return $this->redirect($this->generateUrl('admin-editeur-edit', [
                'id' => $editeur->getId(),
            ]));
        }

        return $this->render('admin/pages/addeditor.html.twig', [
            'form' => $form->createView(),
            'title' => $title,
        ]);
    }


    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        $editeur = $em->getRepository(Editeur::class)->find($id);
        $editeur->setDeletedAt(new \Datetime());

        $em->persist($editeur);
        $em->flush();

        $this->addFlash('success', 'Editeur supprimé');

        return $this->redirectToRoute('admin-home');
    }



}
