<?php

namespace App\Entity;

use App\Repository\ListeTacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeTacheRepository::class)
 */
class ListeTache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="listeTaches")
     */
    private $helper;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="listeTaches")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity=nomListeTache::class, inversedBy="listeTaches")
     */
    private $liste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHelper(): ?User
    {
        return $this->helper;
    }

    public function setHelper(?User $helper): self
    {
        $this->helper = $helper;

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

    public function getListe(): ?nomListeTache
    {
        return $this->liste;
    }

    public function setListe(?nomListeTache $liste): self
    {
        $this->liste = $liste;

        return $this;
    }
}
