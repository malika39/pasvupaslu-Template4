<?php

namespace App\Controller;


use App\Entity\ProfilUser;
use App\Entity\User;
use App\Form\ProfilUserFormType;
use App\Form\UserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MembersController extends AbstractController
{
    use HelperTrait;





    /**
     * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/registration/user_auteur", name="register_user")
     * @param Request $request
     * @param User|null $user
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscrirUser(Request $request, User $user=null, UserPasswordEncoderInterface $encoder )
    {

        if (!$user){
            $user = new User();
            $user->setRoles(['ROLE_MEMBRE']);
        }

//        Création du Formulaire
        $form = $this->createForm(UserFormType::class, $user)
            ->handleRequest($request);

//         Si le formulaire est soumis et valide
        if ($form->isSubmitted()&& $form->isValid()){

// Encoder le mot de passe de l'utilisateur
            $pasword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($pasword);
            //Sauvegarde en BDD
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Notification
            $this->addFlash('notice',
                'Felicitation!');

//            //Rediraction
            return $this->redirectToRoute('security_login');
        }

//    Affichage dans la vue
        return $this->render('members/inscription_user_auteur.html.twig', [
            'form'=>$form->createView()
        ]);


    }

    /**
     * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/registration/user_lecteur", name="register_user1")
     * @param Request $request
     * @param User|null $user
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscrirUser1(Request $request, User $user=null, UserPasswordEncoderInterface $encoder )
    {

        if (!$user){
            $user = new User();
            $user->setRoles(['ROLE_LECTEUR']);
        }

//        Création du Formulaire
        $form = $this->createForm(UserFormType::class, $user)
            ->handleRequest($request);

//         Si le formulaire est soumis et valide
        if ($form->isSubmitted()&& $form->isValid()){

// Encoder le mot de passe de l'utilisateur
            $pasword = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($pasword);
            //Sauvegarde en BDD
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Notification
            $this->addFlash('notice',
                'Felicitation!');

//            //Rediraction
            return $this->redirectToRoute('security_login');
        }

//    Affichage dans la vue
        return $this->render('members/inscription_user_lecteur.html.twig', [
            'form'=>$form->createView()
        ]);


    }



    /**
     * @Route("/registration/user/profil", name="register_user_profil")
     * @param Request $request
     * @param User|null $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function inscrirUserProfil(Request $request, ProfilUser $auterEntity=null )
    {
//переименовать  в профиль
//        if ($auterEntity=null){
//            return $this->redirectToRoute('profil');
//        } else
//        {
//            $auterEntity = new ProfilUser();
//            $auterEntity->setUser($this->getUser());
//
//        }
        if (!$auterEntity){
            $auterEntity = new ProfilUser();
            $auterEntity->setUser($this->getUser());
        }



//        Création du Formulaire
        $form = $this->createForm(ProfilUserFormType::class, $auterEntity)
            ->handleRequest($request);

//         Si le formulaire est soumis et valide
        if ($form->isSubmitted()&& $form->isValid()){
            /** @var UploadedFile $photo*/
            $photo = $auterEntity->getPhoto();
            $fileName = $this->slugify($auterEntity->getPseudo()).'.'.$photo->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $photo->move(
                    $this->getParameter('auter_assets_dir'),
                    $fileName
                );
            } catch (FileException $e) {

            }
            //Mise à jour de l'image
            $auterEntity->setPhoto($fileName);


            //Sauvegarde en BDD
            $em=$this->getDoctrine()->getManager();
            $em->persist($auterEntity);
            $em->flush();


            // Notification
            $this->addFlash('notice',
                'Felicitation, votre  est en ligne!');

//            //Rediraction
            return $this->redirectToRoute('register_user_profil');
        }

//    Affichage dans la vue
        return $this->render('members/profil.html.twig', [
            'form'=>$form->createView()
        ]);


    }







}
