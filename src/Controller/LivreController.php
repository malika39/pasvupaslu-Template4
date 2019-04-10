<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Livres;
use App\Form\CategorieFormType;
use App\Form\LivreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



class LivreController extends AbstractController
{
    use HelperTrait;


    /**
     * @Route("/ajouter_categories", name="ajouter_categories")
     * @param Request $request
     * @param Categories|null $categories
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function AjouterCategorie(Request $request, Categories $categories=null )
    {

        if (!$categories){
            $categories = new Categories();

        }

//        Création du Formulaire
        $form = $this->createForm(CategorieFormType::class, $categories)
            ->handleRequest($request);

//         Si le formulaire est soumis et valide
        if ($form->isSubmitted()&& $form->isValid()){


            //Sauvegarde en BDD
            $em=$this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush();

            // Notification
            $this->addFlash('notice',
                'Felicitation!');

//            //Rediraction
            return $this->redirectToRoute('ajouter_categories');
        }

//    Affichage dans la vue
        return $this->render('livre/ajouter_categories.html.twig', [
            'form'=>$form->createView()
        ]);


    }

    /**
     * @Security("is_granted('ROLE_MEMBRE')")
     * @Route("/ajouter_livre", name="ajouter_livre")
     * @param Request $request
     * @param Livres|null $livres
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function AjouterLivre(Request $request, Livres $livres=null , SessionInterface $session)
    {
//        $session->clear();
//        dump($session);
//        die();
        if (!$livres){
            $livres = new Livres();
            $livres->setUser($this->getUser());

        }

//        Création du Formulaire
        $form = $this->createForm(LivreFormType::class, $livres)
            ->handleRequest($request);

//         Si le formulaire est soumis et valide
        if ($form->isSubmitted()&& $form->isValid()){
            /** @var UploadedFile $photo*/
            $photo = $livres->getPhoto();
            $fileName = $this->slugify($livres->getTitre()).'.'.$photo->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $photo->move(
                    $this->getParameter('livre_assets_dir'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            //Mise à jour de l'image
            $livres->setPhoto($fileName);



            //Sauvegarde en BDD
            $em=$this->getDoctrine()->getManager();
            $em->persist($livres);
            $em->flush();

            // Notification
            $this->addFlash('notice',
                'Felicitation!');

//            //Rediraction
            return $this->redirectToRoute('ajouter_livre');
        }

//    Affichage dans la vue
        return $this->render('livre/ajouter_livres.html.twig', [
            'form'=>$form->createView()
        ]);


    }


    /**
     *
     * @Route("/livre/{id}.html", name="show_livre", methods={"GET", "POST"})
     * @param Livres $livres
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function showLivre(Livres $livres)
    {


        return $this->render('livre/livre.html.twig', [
            'livre'=>$livres,
//            'categories'=> $categories
        ]);
    }

    /**
     *
     * @Route("/livres", name="show_livres")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function showLivres()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Livres::class);
        $livres = $repository->findBy([],['id'=>'DESC']);

//        dump($livres);
//        die();
        return $this->render('livre/livres.html.twig', [
            'livres'=>$livres
        ]);
    }
    /**
     *
     * @Route("/livres_auteur", name="show_livres_auteur",  methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function showLivresAuteur()
    {

        return $this->render('livre/livres_auter.html.twig');
    }



}
