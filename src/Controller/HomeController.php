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
     * @Route("categories", name="category")
     */
    public function category() {

        return $this->render("pages/category.html.twig", [
            'current_menu' => 'category',
        ]);

    }

    /**
     * @Route("editeurs", name="editors")
     */
    public function editors() {

        return $this->render("pages/editors.html.twig", [
            'current_menu' => 'editors',
        ]);

    }

    /**
     * @Route("interview_editeurs", name="interview_editeurs")
     */
    public function interview_editeurs() {

        return $this->render("pages/interview-editors.html.twig", [
            'current_menu' => 'editors',
        ]);

    }

    /**
     * @Route("login", name="login")
     */
    public function identification() {

        return $this->render("pages/identification.html.twig");

    }

    /**
     * @Route("inscription-auteur", name="inscription-auteur")
     */
    public function registration_author() {

        return $this->render("pages/registration-author.html.twig");

    }

    /**
     * @Route("inscription-lecteur", name="inscription-lecteur")
     */
    public function registration_reader() {

        return $this->render("pages/registration-reader.html.twig");

    }

    /**
     * @Route("interviews", name="interviews")
     */
    public function interviews() {

        return $this->render("pages/interviews.html.twig", [
            'current_menu' => 'interviews',
        ]);

    }

    /**
     * @Route("interviews-view", name="interviews_view")
     */
    public function interviews_view() {

        return $this->render("pages/interviews-view.html.twig", [
            'current_menu' => 'interviews',
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


}