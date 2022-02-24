<?php

namespace App\Entity;

use App\Repository\NomListeTacheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NomListeTacheRepository::class)
 */
class NomListeTache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="nomListeTaches")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=ListeTache::class, mappedBy="liste")
     */
    private $listeTaches;

    public function __construct()
    {
        $this->listeTaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    /**
     * @return Collection|ListeTache[]
     */
    public function getListeTaches(): Collection
    {
        return $this->listeTaches;
    }

    public function addListeTach(ListeTache $listeTach): self
    {
        if (!$this->listeTaches->contains($listeTach)) {
            $this->listeTaches[] = $listeTach;
            $listeTach->setListe($this);
        }

        return $this;
    }

    public function removeListeTach(ListeTache $listeTach): self
    {
        if ($this->listeTaches->removeElement($listeTach)) {
            // set the owning side to null (unless already changed)
            if ($listeTach->getListe() === $this) {
                $listeTach->setListe(null);
            }
        }

        return $this;
    }
}
