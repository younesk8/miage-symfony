<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UERepository::class)
 */
class UE
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Module::class, mappedBy="UE")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity=UserUE::class, mappedBy="UE")
     */
    private $userUEs;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="uEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestre;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->userUEs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setUE($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getUE() === $this) {
                $module->setUE(null);
            }
        }

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
            $userUE->setUE($this);
        }

        return $this;
    }

    public function removeUserUE(UserUE $userUE): self
    {
        if ($this->userUEs->removeElement($userUE)) {
            // set the owning side to null (unless already changed)
            if ($userUE->getUE() === $this) {
                $userUE->setUE(null);
            }
        }

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
}
