<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    /**
     * @Route("/admin", name="admin_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {

        return $this->render("admin/pages/index.html.twig");

    }

    /**
     * @Route("/admin/pages", name="admin_page")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function page() {

        return $this->render("admin/pages/pages.html.twig");

    }

    /**
     * @Route("/admin/category", name="admin_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function category() {

        return $this->render("admin/pages/category.html.twig");

    }

    /**
     * @Route("/admin/add_interview", name="admin_addinterview")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addinterview() {

        return $this->render("admin/pages/addinterview.html.twig");

    }


}