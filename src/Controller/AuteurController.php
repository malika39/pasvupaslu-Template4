<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.03.2019
 * Time: 20:59
 */

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Livres;
use App\Entity\ProfilUser;
use App\Entity\User;
use App\Form\CategorieFormType;
use App\Form\LivreFormType;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;



class AuteurController extends AbstractController
{


    /**
     *
     * @Route("/auteurs", name="show_auters")
     * @param User $users
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function showAuters( )
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
            $users = $repository->findBy([],['id'=>'DESC']);


//        dump($users);
//        die();
        return $this->render('auteur/auteurs.html.twig', [
            'users'=>$users,
//            'livres'=>$users->$this->getId()
        ]);

    }
    /**
     * @Route("/profil/{id}", name="profil_auter", methods={"GET","POST"})
     * @param $id
     * @return Response
     */
    public function profilAuter($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $auter = $entityManager->getRepository(User::class)->find($id);

//dump($auter);
//die();
//        $entityManager->remove($auter);
//        $entityManager->flush();

        return $this->render('auteur/auter_profil.html.twig', [
            'user'=>$auter,
//            'id'
//            'livres'=>$users->$this->getId()
        ]);
    }


}