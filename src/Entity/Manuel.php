<?php

namespace App\Entity;

use App\Repository\ManuelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ManuelRepository::class)
 */
class Manuel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="manuels")
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="manuels")
     */
    private $categorie1;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="manuels")
     */
    private $categorie2;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="manuels")
     */
    private $categorie3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCategorie1(): ?Category
    {
        return $this->categorie1;
    }

    public function setCategorie1(?Category $categorie1): self
    {
        $this->categorie1 = $categorie1;

        return $this;
    }

    public function getCategorie2(): ?Category
    {
        return $this->categorie2;
    }

    public function setCategorie2(?Category $categorie2): self
    {
        $this->categorie2 = $categorie2;

        return $this;
    }

    public function getCategorie3(): ?Category
    {
        return $this->categorie3;
    }

    public function setCategorie3(?Category $categorie3): self
    {
        $this->categorie3 = $categorie3;

        return $this;
    }
}
