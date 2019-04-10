<?php
namespace App\Controller;

    use App\Entity\Categories;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Flex\Response;

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
     * @Route("livressss", name="books")
     */
    public function books() {

        return $this->render("pages/books.html.twig", [
            'current_menu' => 'books',
        ]);

    }

    /**
     * @Route("/categories/{categorie}", name="category",
     *     methods={"GET"})
     * @param Categories|null $categories
     * @return Response
     */
    public function categories( Categories $categories=null) {


        return $this->render("pages/category.html.twig", [
            'categories' => $categories,
            'livres' => $categories->getLivre(),
            'categorie'=>$categories->getCategorie()
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

//    /**
//     * @Route("login", name="login")
//     */
//    public function identification() {
//
//        return $this->render("pages/identification.html.twig");
//
//    }

      /**
      * @Route("inscription-auteurs", name="registration-authors")
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
        /**
         * @Route("auter", name="auter")
         */
        public function auter() {

            return $this->render("members/profil.html.twig");

        }

        /**
         * @Route("identification", name="identification")
         */
        public function identification() {
            return $this->render("pages/identification.html.twig");
        }


        /**
         * @Route("/l_adma", name="admna")
         */
        public function loginAdmin()
        {
            return $this->render('members/tim.html.twig');
        }
}