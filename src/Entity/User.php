<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("username", message="Adresse email déjà utilisée")
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $lastname;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Champ obligatoire")
     * @Assert\Length(min="5",max="30",minMessage="Minimum 12 caractères - Maximum 30 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password",message="La confirmation du mot de passe n'est pas valide")
     */
    private $password;

    /**
     * @Assert\NotBlank(message="Champ obligatoire")
     */
    private $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity=Intervention::class, mappedBy="user")
     */
    private $interventions;

    /**
     * @ORM\OneToMany(targetEntity=Pointage::class, mappedBy="user")
     */
    private $pointages;

    /**
     * @ORM\OneToMany(targetEntity=Identifiant::class, mappedBy="user")
     */
    private $identifiants;

    /**
     * @ORM\OneToMany(targetEntity=Manuel::class, mappedBy="auteur")
     */
    private $manuels;

    /**
     * @ORM\OneToMany(targetEntity=Reunion::class, mappedBy="auteur")
     */
    private $reunions;

    /**
     * @ORM\ManyToOne(targetEntity=AdminDeparture::class, inversedBy="users")
     */
    private $departure;

    /**
     * @ORM\OneToMany(targetEntity=ListeTache::class, mappedBy="helper")
     */
    private $listeTaches;

    /**
     * @ORM\OneToMany(targetEntity=NomListeTache::class, mappedBy="user")
     */
    private $nomListeTaches;
    
    public function __construct()
    {
        $this -> createdAt = new \Datetime();
        $this->interventions = new ArrayCollection();
        $this->pointages = new ArrayCollection();
        $this->identifiants = new ArrayCollection();
        $this->manuels = new ArrayCollection();
        $this->reunions = new ArrayCollection();
        $this->listeTaches = new ArrayCollection();
        $this->nomListeTaches = new ArrayCollection();
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getSalt()
    {
        
    }

    public function eraseCredentials()
    {
        
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password = $confirm_password;

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
            $intervention->setUser($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getUser() === $this) {
                $intervention->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pointage[]
     */
    public function getPointages(): Collection
    {
        return $this->pointages;
    }

    public function addPointage(Pointage $pointage): self
    {
        if (!$this->pointages->contains($pointage)) {
            $this->pointages[] = $pointage;
            $pointage->setUser($this);
        }

        return $this;
    }

    public function removePointage(Pointage $pointage): self
    {
        if ($this->pointages->removeElement($pointage)) {
            // set the owning side to null (unless already changed)
            if ($pointage->getUser() === $this) {
                $pointage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Identifiant[]
     */
    public function getIdentifiants(): Collection
    {
        return $this->identifiants;
    }

    public function addIdentifiant(Identifiant $identifiant): self
    {
        if (!$this->identifiants->contains($identifiant)) {
            $this->identifiants[] = $identifiant;
            $identifiant->setUser($this);
        }

        return $this;
    }

    public function removeIdentifiant(Identifiant $identifiant): self
    {
        if ($this->identifiants->removeElement($identifiant)) {
            // set the owning side to null (unless already changed)
            if ($identifiant->getUser() === $this) {
                $identifiant->setUser(null);
            }
        }

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
            $manuel->setAuteur($this);
        }

        return $this;
    }

    public function removeManuel(Manuel $manuel): self
    {
        if ($this->manuels->removeElement($manuel)) {
            // set the owning side to null (unless already changed)
            if ($manuel->getAuteur() === $this) {
                $manuel->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reunion[]
     */
    public function getReunions(): Collection
    {
        return $this->reunions;
    }

    public function addReunion(Reunion $reunion): self
    {
        if (!$this->reunions->contains($reunion)) {
            $this->reunions[] = $reunion;
            $reunion->setAuteur($this);
        }

        return $this;
    }

    public function removeReunion(Reunion $reunion): self
    {
        if ($this->reunions->removeElement($reunion)) {
            // set the owning side to null (unless already changed)
            if ($reunion->getAuteur() === $this) {
                $reunion->setAuteur(null);
            }
        }

        return $this;
    }

    public function getDeparture(): ?AdminDeparture
    {
        return $this->departure;
    }

    public function setDeparture(?AdminDeparture $departure): self
    {
        $this->departure = $departure;

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
            $listeTach->setHelper($this);
        }

        return $this;
    }

    public function removeListeTach(ListeTache $listeTach): self
    {
        if ($this->listeTaches->removeElement($listeTach)) {
            // set the owning side to null (unless already changed)
            if ($listeTach->getHelper() === $this) {
                $listeTach->setHelper(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NomListeTache[]
     */
    public function getNomListeTaches(): Collection
    {
        return $this->nomListeTaches;
    }

    public function addNomListeTach(NomListeTache $nomListeTach): self
    {
        if (!$this->nomListeTaches->contains($nomListeTach)) {
            $this->nomListeTaches[] = $nomListeTach;
            $nomListeTach->setUser($this);
        }

        return $this;
    }

    public function removeNomListeTach(NomListeTache $nomListeTach): self
    {
        if ($this->nomListeTaches->removeElement($nomListeTach)) {
            // set the owning side to null (unless already changed)
            if ($nomListeTach->getUser() === $this) {
                $nomListeTach->setUser(null);
            }
        }

        return $this;
    }

   
}
