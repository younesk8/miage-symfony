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
