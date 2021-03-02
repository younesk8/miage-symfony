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
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="promotions")
     */
    private $etudients;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promotion")
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="promotion")
     */
    private $userSemestres;

    public function __construct()
    {
        $this->etudients = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->userSemestres = new ArrayCollection();
        $this->userModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getEtudients(): Collection
    {
        return $this->etudients;
    }

    public function addEtudient(User $etudient): self
    {
        if (!$this->etudients->contains($etudient)) {
            $this->etudients[] = $etudient;
        }

        return $this;
    }

    public function removeEtudient(User $etudient): self
    {
        $this->etudients->removeElement($etudient);

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
}
