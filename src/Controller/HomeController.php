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
     * @Route("interviews", name="interviews")
     */
    public function interviews() {

        return $this->render("pages/interviews.html.twig", [
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


}