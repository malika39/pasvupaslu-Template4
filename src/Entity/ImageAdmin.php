<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use App\Services\Uploader;


/**
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
     * @var UploadedFile
     *
     * @Assert\Image(
     *     mimeTypes={"image/png", "image/jpeg"},
     *     mimeTypesMessage="Vérifiez le format de votre image",
     *     maxSize="2M", maxSizeMessage="Attention, votre image est trop lourde.")
     *
     */
    private $file;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('file', new Assert\Image());

        $metadata->addPropertyConstraint('description', new Assert\Type('string'));
        $metadata->addPropertyConstraint('description', new Assert\NotNull());
    }
    /**
     * @var bool
     */
    private $deletedImage;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Editeur",inversedBy="imagesAdmin")
     *
     */
    private $editeur;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\InterView",inversedBy="imagesAdmin")
     *
     */
    private $interView;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UploadedFile|null
     * @var [UploaderFile]
     */

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * @param Uploader|null $file
     * @return ImageAdmin
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }
    /**
     * @ORM\Column(type="string")
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
}
