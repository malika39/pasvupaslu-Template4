<?php

namespace App\Controller\Admin;

use App\Entity\Editeur;
use App\Entity\ImageAdmin;
use App\Form\EditeurType;
use App\Services\Uploader;
use App\Services\Slugger;
use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditeurController extends AbstractController
{

    /**
     * @Route("/admin/editeurs", name="admin-editeurs", methods={"GET"})
     */
    public function listEditeur(EditeurRepository $editeurs): Response
    {
        return $this->render('admin/editeurs/list.html.twig', [
            'editeurs' => $editeurs->findAll(),
        ]);
    }
    /**
     * @Route("admin/editeur/{slug}/edit", name="editeur_edit", methods={"GET", "POST"})
     */
    public function editor(Request $req, $id, Slugger $slugger,Uploader $file)
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
        } else {
            $editeur->addImage(new ImageAdmin());



        }

        $form = $this->createForm(EditeurType::class, $editeur);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($editeur->getImagesAdmin() as $image) {
                if ($file = $image->getFie()) {
                    $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                    $image->setName($filename);
                    $file->move($this->getParameter('imagesAdmin_directory'), $filename);
                }

            }

            $slug = $slugger->slugify($editeur);
            $editeur->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($editeur);
            $em->flush();

            $this->addFlash('success', 'Editeur ajouté');

            return $this->redirect($this->generateUrl('editeur_edit', [
                'id' => $editeur->getId(),
            ]));
        }

        return $this->render('admin/editeur_editor.html.twig', [
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
