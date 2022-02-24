<?php

namespace App\Entity;

use App\Entity\Service;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\InterventionRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InterventionRepository::class)
 */
class Intervention
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="interventions")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="interventions")
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $agent;

    /**
     * @ORM\ManyToOne(targetEntity=service::class, inversedBy="interventions")
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity=Yesorno::class, inversedBy="interventions")
     */
    private $origine;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $clotureAt;
    
    public function __construct()
    {
        $this -> createdAt = new \Datetime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getOrigine(): ?Yesorno
    {
        return $this->origine;
    }

    public function setOrigine(?Yesorno $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getClotureAt(): ?\DateTimeInterface
    {
        return $this->clotureAt;
    }

    public function setClotureAt(?\DateTimeInterface $clotureAt): self
    {
        $this->clotureAt = $clotureAt;

        return $this;
    }
}
