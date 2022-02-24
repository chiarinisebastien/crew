<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
     * @ORM\OneToMany(targetEntity=Intervention::class, mappedBy="service")
     */
    private $interventions;

    /**
     * @ORM\OneToMany(targetEntity=ListeTache::class, mappedBy="service")
     */
    private $listeTaches;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->listeTaches = new ArrayCollection();
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
     * @return Collection|Intervention[]
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions[] = $intervention;
            $intervention->setService($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getService() === $this) {
                $intervention->setService(null);
            }
        }

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
            $listeTach->setService($this);
        }

        return $this;
    }

    public function removeListeTach(ListeTache $listeTach): self
    {
        if ($this->listeTaches->removeElement($listeTach)) {
            // set the owning side to null (unless already changed)
            if ($listeTach->getService() === $this) {
                $listeTach->setService(null);
            }
        }

        return $this;
    }
}
