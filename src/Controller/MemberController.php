<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController {

    /**
     * @Route("profile", name="member_profil")
     */
    public function profil() {

        return $this->render('pages/profil.html.twig');

    }

    /**
     * @Route("parametre", name="member_settings")
     */
    public function settings() {

        return $this->render('pages/settings.html.twig');

    }

    /**
     * @Route("mot-de-passe-oublie", name="member_password")
     */
    public function password() {

        return $this->render('pages/password.html.twig');

    }

}
