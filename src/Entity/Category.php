<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Manuel::class, mappedBy="categorie1")
     */
    private $manuels;

    public function __construct()
    {
        $this->manuels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Manuel[]
     */
    public function getManuels(): Collection
    {
        return $this->manuels;
    }

    public function addManuel(Manuel $manuel): self
    {
        if (!$this->manuels->contains($manuel)) {
            $this->manuels[] = $manuel;
            $manuel->setCategorie1($this);
        }

        return $this;
    }

    public function removeManuel(Manuel $manuel): self
    {
        if ($this->manuels->removeElement($manuel)) {
            // set the owning side to null (unless already changed)
            if ($manuel->getCategorie1() === $this) {
                $manuel->setCategorie1(null);
            }
        }

        return $this;
    }
}
