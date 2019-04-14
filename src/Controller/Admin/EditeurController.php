<?php

namespace App\Controller\Admin;

use App\Controller\HelperTrait;
use App\Entity\Editeur;
use App\Entity\ImageAdmin;
use App\Entity\Question;
use App\Form\EditeurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class EditeurController extends AbstractController
{

    use HelperTrait;

    /**
     * @Route("/admin/Editeur", name="admin-editeurs", methods={"GET"})
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

    public function editor(Request $req, $id)
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
            $editeur->addImageFile(new ImageAdmin());
            $editeur->addQuestions(new Question());

        }

        $form = $this->createForm(EditeurType::class, $editeur);

        $form->handleRequest($req);


        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($editeur->getImagesAdmin() as $image) {
                if ($file = $image->getFile()) {
                    $filename = $this->slugify($editeur->getName()).'-'.$image->getAlt().'.'.'jpg';
                    $image->setAlt($filename);
                    $file->move($this->getParameter('imagesAdmin_directory'), $filename);
                }
                $editeur->addImageFile($image);
            }

            foreach ($editeur->getQuestions() as $questions) {
                {
                    if(!$questions){
                        $questions =$this->getDoctrine()->getManager();
                    }


                }

                $editeur->addQuestions($questions);
            }
            $slug = $this->slugify($editeur->getName());
            $editeur->setSlug($slug);

            $em = $this->getDoctrine()->getManager();
            $em->persist($editeur);
            $em->flush();

            $this->addFlash('success', 'Editeur ajouté');

            return $this->redirect($this->generateUrl('admin-editeur-edit', [
                'id' => $editeur->getId(),

            ]));
        }
        dump($editeur);
        return $this->render('admin/pages/addeditor.html.twig', [
            'form' => $form->createView(),
            'title' => $title,
            'editeur' => $editeur,
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

    /**
     * @Route("/editeur/{id}", name="editeur-show", methods={"GET"})
     */
    public function showI(Editeur $editeur)
    {
        return $this->render('pages/interview-editors.html.twig', [
            'editeur' => $editeur,
        ]);
    }



}
