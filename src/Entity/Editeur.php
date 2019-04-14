<?php
/**
 * Created by PhpStorm.
 * User: Surface
 * Date: 31/03/2019
 * Time: 21:21
 */

namespace App\Entity;


use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @property  question
 * @property  question
 *
 *
 * @property  question
 * @property DateTime dateCreated
 * @property  question
 * @ORM\Table(name="editeur",
 *            options={"row_format":"DYNAMIC"},)
 * @ORM\Entity(repositoryClass="App\Repository\EditeurRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Editeur

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
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     *
     *
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string")
     * @Assert\NotBlank()
     *
     *
     */
    private $lastName;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    public $slug;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=true)
     */
    private $createAt;


    /**
     * @ORM\Column(type="string")
     */
    private $address;



    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $country;


    /**
     * @var string
     *
     * @ORM\Column(type="text",nullable=true)
     *
     *
     *
     */
    private $function;

    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\ImageAdmin",mappedBy="editeur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid
     */
    private $imagesAdmin;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="editeur", cascade={"persist"})
     */
    private $questions;




    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('address', new Assert\Type('string'));
        $metadata->addPropertyConstraint('address', new Assert\NotNull());


        $metadata->addPropertyConstraint('city', new Assert\Type('string'));
        $metadata->addPropertyConstraint('city', new Assert\NotNull());

        $metadata->addPropertyConstraint('postCode', new Assert\Type('integer'));
        $metadata->addPropertyConstraint('postCode', new Assert\NotNull());

        ;
    }
    public function __construct()
    {
        $this->imagesAdmin = new ArrayCollection();
        $this->questions = new ArrayCollection();
        $this->dateCreated = new \DateTime();
        // Null values are ignored by unique constraints
        $this->deletedAt = date_create('0000-00-00 00:00:00');

    }

    public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
    public function setName(?string $name): Editeur
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLastName(?string $lastName): Editeur
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreateAt(): self
    {
        try {
            $this->createAt = new DateTime();
        } catch (\Exception $e) {
        }

        return $this;
    }

    public function getCreateAt()
    {
        return $this->createAt;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }



    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode(?int $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }


    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }
    /**
     * @return ArrayCollection
     */
    public function getImagesAdmin()
    {
        return $this->imagesAdmin;
    }
    /**
     * @return ArrayCollection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
    /**
     * @return ArrayCollection
     */
    public function getQuestion()
    {
        return $this->getQuestions();
    }

    /**
     * @return ArrayCollection
     */
    public function getImageFile()
    {
        return $this->getImagesAdmin();
    }

    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }
    public function addQuestion(Question $question)
    {
        $this->questions->add($question);

        $question->setEditeur($this);

    }
    public function addQuestions(Question $question)
    {
        if(!$this->questions->contains($question))
        {
            $this->questions->add($question);
        }

    }
    public function setImagesAdmin($imagesAdmin)
    {
        $this->imagesAdmin = $imagesAdmin;
    }
    public function addImageFile(ImageAdmin $imageAdmin)
    {
        $this->imagesAdmin->add($imageAdmin);

        $imageAdmin->setEditeur($this);

    }
    /**
     * @param UploadedFile
     */
    public function addImageAdmin(UploadedFile $imageAdmin)
    {
        if(!$this->imagesAdmin->contains($imageAdmin))
        {
            $this->imagesAdmin->add($imageAdmin);
        }

    }

    public function removeImageAdmin(ImageAdmin $imageAdmin)
    {
        $this->imagesAdmin->removeElement($imageAdmin);
    }
    /**
     * @param ImageAdmin $imageAdmin
     */
    public function removeImageFile(ImageAdmin $imageAdmin)
    {
        $this->imagesAdmin->removeElement($imageAdmin);

    }
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    

    public function removeQuestion(Question $question)
    {
        $this->questions->remove($question);
    }
    

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }

    
}