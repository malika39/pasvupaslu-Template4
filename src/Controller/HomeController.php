<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index() {

        return $this->render("pages/index.html.twig", [
            'current_menu' => 'home',
        ]);

    }

    /**
     * @Route("a-propos-de-nous", name="about")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function about() {

        return $this->render("pages/about.html.twig", [
            'current_menu' => 'about',
        ]);

    }

    /**
     * @Route("auteurs", name="authors")
     */
    public function authors() {

        return $this->render("pages/authors.html.twig", [
            'current_menu' => 'authors',
        ]);

    }

    /**
     * @Route("lecteurs", name="readers")
     */
    public function readers() {

        return $this->render("pages/readers.html.twig", [
            'current_menu' => 'readers',
        ]);

    }

    /**
     * @Route("livres", name="books")
     */
    public function books() {

        return $this->render("pages/books.html.twig", [
            'current_menu' => 'books',
        ]);

    }

    /**
     * @Route("livres/nom", name="book_view")
     */
    public function book_view() {

        return $this->render("pages/book-view.html.twig");

    }

    /**
     * @Route("categories", name="category")
     */
    public function category() {

        return $this->render("pages/category.html.twig", [
            'current_menu' => 'category',
        ]);

    }

    /**
     * @Route("editeurs", name="editeurs")
     */
    public function editors() {

        return $this->render("pages/editors.html.twig", [
            'current_menu' => 'editeurs',
        ]);

    }

    /**
     * @Route("interview_editeurs", name="interview_editeurs")
     */
    public function interview_editeurs() {

        return $this->render("pages/interview-editors.html.twig", [
            'current_menu' => 'editeurs',
        ]);

    }

    /**
     * @Route("identification", name="identification")
     */
    public function identification() {

        return $this->render("pages/identification.html.twig");

    }

    /**
     * @Route("inscription-auteur", name="registration-author")
     */
    public function registration_author() {

        return $this->render("pages/registration-author.html.twig");

    }

    /**
     * @Route("inscription-lecteur", name="registration-reader")
     */
    public function registration_reader() {

        return $this->render("pages/registration-reader.html.twig");

    }

    /**
     * @Route("interViews", name="interViews")
     */
    public function interviews() {

        return $this->render("pages/interviews.html.twig", [
            'current_menu' => 'interViews',
        ]);

    }

    /**
     * @Route("interView-view", name="interView_view")
     */
    public function interView_view() {

        return $this->render("pages/interview-view.html.twig", [
            'current_menu' => 'interView',
        ]);

    }

    /**
     * @Route("evenements", name="events")
     */
    public function events() {

        return $this->render("pages/events.html.twig", [
            'current_menu' => 'events',
        ]);

    }

    /**
     * @Route("forum", name="forum")
     */
    public function forum() {

        return $this->render("pages/forum.html.twig");

    }

    /**
     * @Route("forum/topic", name="forum_topic")
     */
    public function topic() {

        return $this->render("pages/topic.html.twig");

    }

    /**
     * @Route("forum/add-topic", name="forum_addTopic")
     */
    public function add_topic() {

        return $this->render("pages/add_topic.html.twig");

    }

    /**
     * @Route("salon-pas-vu-pas-lu", name="salon")
     */
    public function salon() {

        return $this->render("pages/salon.html.twig");

    }

    /**
     * @Route("revue-de-presse/", name="blog")
     */
    public function blog() {

        return $this->render("pages/blog.html.twig");

    }

    /**
     * @Route("article", name="article")
     */
    public function article() {

        return $this->render("pages/article.html.twig");

    }

    /**
     * @Route("rendez-vous", name="rendez_vous")
     */
    public function rendezvous() {

        return $this->render("pages/rendez-vous.html.twig");

    }

    /**
     * @Route("un-auteur-emerge", name="emerge")
     */
    public function emerge() {

        return $this->render("pages/emerge.html.twig");

    }

    /**
     * @Route("lecteurs-lu", name="allbooks")
     */
    public function allbooks() {

        return $this->render("pages/all-books.html.twig");

    }

    /**
     * @Route("Informations-legales", name="legal")
     */
    public function legal() {

        return $this->render("pages/legal.html.twig");

    }


}
