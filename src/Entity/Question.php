<?php
/**
 * Created by PhpStorm.
 * User: Surface
 * Date: 31/03/2019
 * Time: 21:21
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Table(name="question",
 *            options={"row_format":"DYNAMIC"},))
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Question

{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=191)
     * @Assert\NotBlank()
     *
     *
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="$content", type="string", )
     * @Assert\NotBlank()
     *
     *
     */
    private $content;



    /**
     * @ORM\Column(type="text")
     */
    private $response;





    /**
     * @var Editeur
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Editeur", inversedBy="questions")
     * @ORM\JoinColumn(name="editeur_id", referencedColumnName="id", onDelete="CASCADE",nullable=true)
     */
    private $editeur;

    /**
     * @var InterView
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\InterView", inversedBy="questions")
     * @ORM\JoinColumn(name="interView_id", referencedColumnName="id", onDelete="CASCADE",nullable=true)
     *
     */
    private $interView;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('$content', new Assert\Type('text'));
        $metadata->addPropertyConstraint('$content', new Assert\NotNull());


        $metadata->addPropertyConstraint('$response', new Assert\Type('text'));
        $metadata->addPropertyConstraint('$response', new Assert\NotNull());

        ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setName(?string $name): Question
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }





    public function getContent()
    {
        return $this->content;
    }


    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response): void
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * @param mixed $editeur
     */
    public function setEditeur($editeur): void
    {
        $this->editeur = $editeur;
    }

    /**
     * @return mixed
     */
    public function getInterView()
    {
        return $this->interView;
    }

    /**
     * @param mixed $interView
     */
    public function setInterView($interView): void
    {
        $this->interView = $interView;
    }


}