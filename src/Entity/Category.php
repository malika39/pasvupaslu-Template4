<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Table(name="category",
 *            options={"row_format":"DYNAMIC"},)
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nameCategory;

    /**
     *  @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category",orphanRemoval=true)
     *
     */
    private $articles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $category): self
    {
        $this->nameCategory = $category;

        return $this;
    }
    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }


    /**
     * @param string $namecategory
     */
    public function __construct($namecategory) {
        $this->articles = new ArrayCollection();
        $this->setNameCategory($namecategory);
    }

}
