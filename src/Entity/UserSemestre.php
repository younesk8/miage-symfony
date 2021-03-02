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
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestre;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudient;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ajac;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valide;

    /**
     * @ORM\OneToMany(targetEntity=UserModule::class, mappedBy="userSemestre")
     */
    private $userModules;

    public function __construct()
    {
        $this->userModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getEtudient(): ?User
    {
        return $this->etudient;
    }

    public function setEtudient(?User $etudient): self
    {
        $this->etudient = $etudient;

        return $this;
    }

    public function getAjac(): ?bool
    {
        return $this->ajac;
    }

    public function setAjac(?bool $ajac): self
    {
        $this->ajac = $ajac;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * @return Collection|UserModule[]
     */
    public function getUserModules(): Collection
    {
        return $this->userModules;
    }

    public function addUserModule(UserModule $userModule): self
    {
        if (!$this->userModules->contains($userModule)) {
            $this->userModules[] = $userModule;
            $userModule->setUserSemestre($this);
        }

        return $this;
    }

    public function removeUserModule(UserModule $userModule): self
    {
        if ($this->userModules->removeElement($userModule)) {
            // set the owning side to null (unless already changed)
            if ($userModule->getUserSemestre() === $this) {
                $userModule->setUserSemestre(null);
            }
        }

        return $this;
    }
}
