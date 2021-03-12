<?php

namespace App\Entity;

use App\Repository\UserSemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserSemestreRepository::class)
 */
class UserSemestre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $asAjac;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $asValide;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestre;

    /**
     * @ORM\OneToMany(targetEntity=UserUE::class, mappedBy="userSemestre")
     */
    private $userUEs;

    public function __construct()
    {
        $this->userUEs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getEtudiant(): ?User
    {
        return $this->etudiant;
    }

    public function setEtudiant(?User $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getAsAjac(): ?bool
    {
        return $this->asAjac;
    }

    public function setAsAjac(?bool $asAjac): self
    {
        $this->asAjac = $asAjac;

        return $this;
    }

    public function getAsValide(): ?bool
    {
        return $this->asValide;
    }

    public function setAsValide(?bool $asValide): self
    {
        $this->asValide = $asValide;

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

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * @return Collection|UserUE[]
     */
    public function getUserUEs(): Collection
    {
        return $this->userUEs;
    }

    public function addUserUE(UserUE $userUE): self
    {
        if (!$this->userUEs->contains($userUE)) {
            $this->userUEs[] = $userUE;
            $userUE->setUserSemestre($this);
        }

        return $this;
    }

    public function removeUserUE(UserUE $userUE): self
    {
        if ($this->userUEs->removeElement($userUE)) {
            // set the owning side to null (unless already changed)
            if ($userUE->getUserSemestre() === $this) {
                $userUE->setUserSemestre(null);
            }
        }

        return $this;
    }
}
