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
    private $date_Naissance;

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
     * @ORM\OneToMany(targetEntity=InscriptionSemestre::class, mappedBy="etudient")
     */
    private $inscriptionSemestres;

    /**
     * @ORM\ManyToMany(targetEntity=Promotion::class, mappedBy="etudients")
     */
    private $promotions;

    /**
     * @ORM\OneToMany(targetEntity=ResponsableNiveau::class, mappedBy="responsable")
     */
    private $responsableNiveaux;

    /**
     * @ORM\OneToMany(targetEntity=ResponsableDiplome::class, mappedBy="responsable")
     */
    private $responsableDiplomes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="etudient")
     */
    private $userSemestres;

    /**
     * @ORM\OneToOne(targetEntity=InfoEtudiant::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $infoEtudiant;

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
        $this->responsableNiveaux = new ArrayCollection();
        $this->responsableDiplomes = new ArrayCollection();
        $this->userSemestres = new ArrayCollection();
        $this->userModules = new ArrayCollection();
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
        return $this->date_Naissance;
    }

    public function setDateNaissance(?string $date_Naissance): self
    {
        $this->date_Naissance = $date_Naissance;

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
            $inscriptionSemestre->setEtudient($this);
        }

        return $this;
    }

    public function removeInscriptionSemestre(InscriptionSemestre $inscriptionSemestre): self
    {
        if ($this->inscriptionSemestres->removeElement($inscriptionSemestre)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionSemestre->getEtudient() === $this) {
                $inscriptionSemestre->setEtudient(null);
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
            $promotion->addEtudient($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            $promotion->removeEtudient($this);
        }

        return $this;
    }

    /**
     * @return Collection|ResponsableNiveau[]
     */
    public function getResponsableNiveaux(): Collection
    {
        return $this->responsableNiveaux;
    }

    public function addResponsableNiveau(ResponsableNiveau $responsableNiveau): self
    {
        if (!$this->responsableNiveaux->contains($responsableNiveau)) {
            $this->responsableNiveaux[] = $responsableNiveau;
            $responsableNiveau->setResponsable($this);
        }

        return $this;
    }

    public function removeResponsableNiveau(ResponsableNiveau $responsableNiveau): self
    {
        if ($this->responsableNiveaux->removeElement($responsableNiveau)) {
            // set the owning side to null (unless already changed)
            if ($responsableNiveau->getResponsable() === $this) {
                $responsableNiveau->setResponsable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ResponsableDiplome[]
     */
    public function getResponsableDiplomes(): Collection
    {
        return $this->responsableDiplomes;
    }

    public function addResponsableDiplome(ResponsableDiplome $responsableDiplome): self
    {
        if (!$this->responsableDiplomes->contains($responsableDiplome)) {
            $this->responsableDiplomes[] = $responsableDiplome;
            $responsableDiplome->setResponsable($this);
        }

        return $this;
    }

    public function removeResponsableDiplome(ResponsableDiplome $responsableDiplome): self
    {
        if ($this->responsableDiplomes->removeElement($responsableDiplome)) {
            // set the owning side to null (unless already changed)
            if ($responsableDiplome->getResponsable() === $this) {
                $responsableDiplome->setResponsable(null);
            }
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
            $userSemestre->setEtudient($this);
        }

        return $this;
    }

    public function removeUserSemestre(UserSemestre $userSemestre): self
    {
        if ($this->userSemestres->removeElement($userSemestre)) {
            // set the owning side to null (unless already changed)
            if ($userSemestre->getEtudient() === $this) {
                $userSemestre->setEtudient(null);
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
}
