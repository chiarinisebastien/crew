<?php

namespace App\Entity;

use App\Repository\IdentifiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdentifiantRepository::class)
 */
class Identifiant
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
    private $quoi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ou;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="identifiants")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuoi(): ?string
    {
        return $this->quoi;
    }

    public function setQuoi(string $quoi): self
    {
        $this->quoi = $quoi;

        return $this;
    }

    public function getOu(): ?string
    {
        return $this->ou;
    }

    public function setOu(string $ou): self
    {
        $this->ou = $ou;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

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
}
