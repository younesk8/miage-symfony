<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
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
    private $anneeScolaire;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="promotions")
     */
    private $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promotion")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="promotion")
     */
    private $userSemestres;

    /**
     * @ORM\ManyToOne(targetEntity=Mention::class, inversedBy="promotions")
     */
    private $mention;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="promotion")
     */
    private $responsables;

    /**
     * @ORM\ManyToOne(targetEntity=Parcours::class, inversedBy="promotions")
     */
    private $parcours;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->userSemestres = new ArrayCollection();
        $this->userModules = new ArrayCollection();
        $this->responsables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeScolaire(): ?string
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(string $anneeScolaire): self
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(User $etudient): self
    {
        if (!$this->etudiants->contains($etudient)) {
            $this->etudiants[] = $etudient;
        }

        return $this;
    }

    public function removeEtudiant(User $etudient): self
    {
        $this->etudiants->removeElement($etudient);

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setPromotion($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromotion() === $this) {
                $groupe->setPromotion(null);
            }
        }

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
            $userSemestre->setPromotion($this);
        }

        return $this;
    }

    public function removeUserSemestre(UserSemestre $userSemestre): self
    {
        if ($this->userSemestres->removeElement($userSemestre)) {
            // set the owning side to null (unless already changed)
            if ($userSemestre->getPromotion() === $this) {
                $userSemestre->setPromotion(null);
            }
        }

        return $this;
    }

    public function getMention(): ?Mention
    {
        return $this->mention;
    }

    public function setMention(?Mention $mention): self
    {
        $this->mention = $mention;

        return $this;
    }

    public function getAnnee(): ?Annee
    {
        return $this->annee;
    }

    public function setAnnee(?Annee $annee): self
    {
        $this->annee = $annee;

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
            $responsable->setPromotion($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getPromotion() === $this) {
                $responsable->setPromotion(null);
            }
        }

        return $this;
    }

    public function getParcours(): ?Parcours
    {
        return $this->parcours;
    }

    public function setParcours(?Parcours $parcours): self
    {
        $this->parcours = $parcours;

        return $this;
    }
}
