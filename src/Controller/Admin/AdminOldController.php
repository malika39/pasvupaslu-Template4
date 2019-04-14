<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminOldController extends AbstractController {

    /**
     * @Route("/admin", name="admin_home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {

        return $this->render("admin/pages/index.html.twig");

    }

    /**
     * @Route("/admin/category", name="admin_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function category() {

        return $this->render("admin/pages/category.html.twig");

    }

    /**
     * @Route("/admin/edit-category", name="admin_edit_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit_category() {

        return $this->render("admin/pages/edit-category.html.twig");

    }


    /**
     * @Route("/admin/article", name="admin_article")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function article() {

        return $this->render("admin/pages/article.html.twig");

    }

    /**
     * @Route("/admin/newarticle", name="admin_newarticle")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newArticle() {

        return $this->render("admin/pages/newarticle.html.twig");

    }

    /**
     * @Route("/admin/listbooks", name="admin_listbooks")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listBooks() {

        return $this->render("admin/pages/listbooks.html.twig");

    }

    /**
     * @Route("/admin/add-book", name="admin_addbook")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addBook() {

        return $this->render("admin/pages/addbook.html.twig");

    }

    /**
     * @Route("/admin/user-readers", name="admin_user_readers")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userReaders() {

        return $this->render("admin/pages/user-readers.html.twig");

    }

    /**
     * @Route("/admin/user-info", name="admin_user_info")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userInfo() {

        return $this->render("admin/pages/user-info.html.twig");

    }

    /**
     * @Route("/admin/user-editor", name="admin_user_editor")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function userEditor() {

        return $this->render("admin/pages/user-editor.html.twig");

    }

    /**
     * @Route("/admin/coupon", name="admin_coupon")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function coupon() {

        return $this->render("admin/pages/coupon.html.twig");

    }

    /**
     * @Route("/admin/comment", name="admin_comment")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function comment() {

        return $this->render("admin/pages/comment.html.twig");

    }

    /**
     * @Route("/admin/rendes-vous", name="admin_appointment")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function appointment() {

        return $this->render("admin/pages/appointment.html.twig");

    }

    /**
     * @Route("/admin/ajouter-rendes-vous", name="admin_add_appointment")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAppointment() {

        return $this->render("admin/pages/add-appointment.html.twig");

    }

}
