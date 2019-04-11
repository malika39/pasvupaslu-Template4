<?php
namespace App\Controller\Security;

use App\Entity\Membres;
use App\Form\MembreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController {


    /**
     * Connection d'un membre
     * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
     * @Route("/login", name="security_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('members/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error
        ));
    }

    /**
     * Déconnexion d'un Membre
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/login_admin", name="admin_login")
     */
    public function loginAdmin(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('admin/pages/login_admin.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error
        ));
    }
//
//    /**
//     * Mot de passe oublier
//     * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
//     * @Route("/forgot", name="security_forgot")
//     * @param \Swift_Mailer $mailer
//     * @param Request $request
//     * @param UserPasswordEncoderInterface $encoder
//     * @param TokenGeneratorInterface $tokenGenerator
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function forgot(\Swift_Mailer $mailer, Request $request, UserPasswordEncoderInterface $encoder, TokenGeneratorInterface $tokenGenerator) {
//
//        # Verifier que la requête et bien envoyer en post
//        if($request->isMethod('POST')) {
//
//            # Récuperer l'email qui & été renseigné dans le champ email
//            $email = $request->request->get('email');
//
//            $entityManager = $this->getDoctrine()->getManager();
//            # Vérifier si l'email saisi et enregistrer dans la base de données
//            $user = $entityManager->getRepository(Membres::class)->findOneBy(['email' => $email]);
//
//            # Générer un token
//            $token = $tokenGenerator->generateToken();
//
//            if($user) {
//                # Si l'adresse mail à été trouver dans la basse de données en lui envoi un mail pour restaurer sont mot de passe
//                $user->setResetToken($token);
//                $entityManager->flush();
//
//                $url = $this->generateUrl('security_forgotten_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
//
//                $message = (new \Swift_Message('Récupérer de votre mot de passe'))
//                    ->setFrom('no-replay@lesatelierscreatifs.com')
//                    ->setTo($user->getEmail())
//                ->setBody($this->render("mail/forgot_password.html.twig", ['url' => $url]),
//                'text/html'
//                );
//
//                $mailer->send($message);
//
//                $this->addFlash('success', "Un lien pour restaurer votre mot de passe vous a été envoyer par mail");
//
//                return $this->redirectToRoute('members/login.html.twig');
//            } else {
//                # Si l'adresse mail na pas été trouver dans la base de données en affiche une erreur
//                $this->addFlash('error', "Adresse email inconnue");
//            }
//
//
//        }
//
//        return $this->render("security/forgot.html.twig");
//
//    }
//
//    /**
//     * @Security("!is_granted('IS_AUTHENTICATED_FULLY')")
//     * @Route("/forgotten_password/{token}", name="security_forgotten_password")
//     * @param Request $request
//     * @param string $token
//     * @param UserPasswordEncoderInterface $encoder
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function forgottenPassword(Request $request, $token, UserPasswordEncoderInterface $encoder) {
//
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $user = $entityManager->getRepository(Membres::class)->findOneBy(['resetToken' => $token]);
//
//        if ($user === null) {
//            # Le token n'est pas correct en regerige ver la page de connection
//            return $this->redirectToRoute('security_login');
//        }
//
//        if($request->isMethod('POST')) {
//
//            $user->setResetToken(null);
//            $user->setMdp($encoder->encodePassword($user, $request->request->get('password')));
//            $entityManager->flush();
//
//            $this->addFlash('success', 'Votre mot de passe à bien été changer vous pouvez maintenant vous connecter');
//
//            return $this->redirectToRoute('security_login');
//
//        }else {
//            # si le token est correct en affiche la vue pour permettre au membre de changer sont mot de passe
//            return $this->render('security/reset_password.html.twig', [
//                'token' => $token
//            ]);
//
//        }
//
//    }
//
//
//    /**
//     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
//     * @Route("/profil", name="security_profil")
//     * @param Request $request
//     * @param UserPasswordEncoderInterface $encoder
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function profil(Request $request, UserPasswordEncoderInterface $encoder) {
//
//        # Récupération des données de l'utilisateur
//        $user = $this->getUser();
//
//        # Créer un Formulaire permettant l'ajout d'un utilisateur
//        $form = $this->createForm(MembreType::class, $user);
//
//        # Traitement des données POST
//        $form->handleRequest($request);
//
//        # Vérification des données du Formulaire
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            // Encoder le mot de passe de l'utilisateur
//            $password = $encoder->encodePassword($user, $user->getMdp());
//            $user->setMdp($password);
//
//            # Envoi les informations à la base de données
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//            # message flash de success
//            $this->addFlash('success', 'Vos informations personnelles en bien etre modifié');
//
//            # Redirection sur la même page
//            return $this->redirectToRoute('security_profil');
//        }
//
//        # Affichage du Formulaire dans la Vue
//        return $this->render('security/profile.html.twig', [
//            'form' => $form->createView()
//        ]);
//
//    }
//    /**
//     * @Route("/membre/{id}", name="delete_membre", methods={"GET","POST"})
//     * @param $id
//     * @return \Symfony\Component\HttpFoundation\RedirectResponse
//     */
//    public function delete_membre($id): \Symfony\Component\HttpFoundation\RedirectResponse
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $contact = $entityManager->getRepository(Membres::class)->find($id);
//
////dump($contact);
////die();
//        $entityManager->remove($contact);
//        $entityManager->flush();
//
//        return $this->redirectToRoute('membres');
//    }



}