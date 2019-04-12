<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use App\Services\Uploader;


/**
 * @property  slug
 * @ORM\Table(name="imagesAdmin",options={"row_format":"DYNAMIC"},)
 * @ORM\Entity(repositoryClass="App\Repository\ImageAdminRepository")
 *
 */
class ImageAdmin
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
     * @ORM\Column(name="alt", type="string", nullable=true)
     */
    private $alt;

    /**
     * @var  [UploadedFile]
     *
     * @Assert\Image(
     *     mimeTypes={"image/png", "image/jpeg"},
     *     mimeTypesMessage="Vérifiez le format de votre image",
     *     maxSize="2M", maxSizeMessage="Attention, votre image est trop lourde.")
     *
     */
    private $file;
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", nullable=true)
     */
    private $slug;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('file', new Assert\Image());

        $metadata->addPropertyConstraint('description', new Assert\Type('string'));

    }
    /**
     * @var bool
     */
    private $deletedImage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editeur",inversedBy="imagesAdmin")
     * @ORM\JoinColumn(name="editeur_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $editeur;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InterView",inversedBy="imagesAdmin")
     * @ORM\JoinColumn(name="interView_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $interView;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getAlt()
    {
        return $this->alt;
    }
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $description;

    public function getEditeur(): Editeur
    {
        return $this->editeur;
    }
    public function setEditeur(Editeur $editeur)
    {
        $this->editeur = $editeur;
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
    /**
     * @return bool
     */
    public function isDeletedImage(): ?bool
    {
        return $this->deletedImage;
    }

    public function setDeletedImage(bool $deletedImage): void
    {
        $this->deletedImage = $deletedImage;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
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

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * @param mixed $deletedAt
     */
    public function setDeletedAt($deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
