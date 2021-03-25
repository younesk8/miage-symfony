<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
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
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_Fixe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel_Portable;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionSemestre::class, mappedBy="etudiant")
     */
    private $inscriptionSemestres;

    /**
     * @ORM\ManyToMany(targetEntity=Promotion::class, mappedBy="etudiants")
     */
    private $promotions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="etudiant")
     */
    private $userSemestres;

    /**
     * @ORM\OneToOne(targetEntity=InfoEtudiant::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $infoEtudiant;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="user")
     */
    private $responsables;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __construct()
    {
        $this->inscriptionSemestres = new ArrayCollection();
        $this->promotions = new ArrayCollection();
        $this->userSemestres = new ArrayCollection();
        $this->responsables = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->tel_Fixe;
    }

    public function setTelFixe(?string $tel_Fixe): self
    {
        $this->tel_Fixe = $tel_Fixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->tel_Portable;
    }

    public function setTelPortable(?string $tel_Portable): self
    {
        $this->tel_Portable = $tel_Portable;

        return $this;
    }

    /**
     * @return Collection|InscriptionSemestre[]
     */
    public function getInscriptionSemestres(): Collection
    {
        return $this->inscriptionSemestres;
    }

    public function addInscriptionSemestre(InscriptionSemestre $inscriptionSemestre): self
    {
        if (!$this->inscriptionSemestres->contains($inscriptionSemestre)) {
            $this->inscriptionSemestres[] = $inscriptionSemestre;
            $inscriptionSemestre->setEtudiant($this);
        }

        return $this;
    }

    public function removeInscriptionSemestre(InscriptionSemestre $inscriptionSemestre): self
    {
        if ($this->inscriptionSemestres->removeElement($inscriptionSemestre)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionSemestre->getEtudiant() === $this) {
                $inscriptionSemestre->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->addEtudiant($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            $promotion->removeEtudiant($this);
        }

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|UserSemestre[]
     */
    public function getUserSemestres(): Collection
    {
        return $this->userSemestres;
    }

    public function addUserSemestre(UserSemestre $userSemestre): self
    {
        if (!$this->userSemestres->contains($userSemestre)) {
            $this->userSemestres[] = $userSemestre;
            $userSemestre->setEtudiant($this);
        }

        return $this;
    }

    public function removeUserSemestre(UserSemestre $userSemestre): self
    {
        if ($this->userSemestres->removeElement($userSemestre)) {
            // set the owning side to null (unless already changed)
            if ($userSemestre->getEtudiant() === $this) {
                $userSemestre->setEtudiant(null);
            }
        }

        return $this;
    }

    public function getInfoEtudiant(): ?InfoEtudiant
    {
        return $this->infoEtudiant;
    }

    public function setInfoEtudiant(InfoEtudiant $infoEtudiant): self
    {
        $this->infoEtudiant = $infoEtudiant;

        // set the owning side of the relation if necessary
        if ($infoEtudiant->getUser() !== $this) {
            $infoEtudiant->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Responsable[]
     */
    public function getResponsables(): Collection
    {
        return $this->responsables;
    }

    public function addResponsable(Responsable $responsable): self
    {
        if (!$this->responsables->contains($responsable)) {
            $this->responsables[] = $responsable;
            $responsable->setUser($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getUser() === $this) {
                $responsable->setUser(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom." ".$this->prenom ;
    }
}
