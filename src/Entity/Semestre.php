<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
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
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="semestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=Module::class, mappedBy="semestre")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity=InscriptionSemestre::class, mappedBy="semestre")
     */
    private $inscriptionSemestres;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="semestre")
     */
    private $userSemestres;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
        $this->inscriptionSemestres = new ArrayCollection();
        $this->userSemestres = new ArrayCollection();
        $this->userModules = new ArrayCollection();
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
            $module->setSemestre($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getSemestre() === $this) {
                $module->setSemestre(null);
            }
        }

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
            $inscriptionSemestre->setSemestre($this);
        }

        return $this;
    }

    public function removeInscriptionSemestre(InscriptionSemestre $inscriptionSemestre): self
    {
        if ($this->inscriptionSemestres->removeElement($inscriptionSemestre)) {
            // set the owning side to null (unless already changed)
            if ($inscriptionSemestre->getSemestre() === $this) {
                $inscriptionSemestre->setSemestre(null);
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
            $userSemestre->setSemestre($this);
        }

        return $this;
    }

    public function removeUserSemestre(UserSemestre $userSemestre): self
    {
        if ($this->userSemestres->removeElement($userSemestre)) {
            // set the owning side to null (unless already changed)
            if ($userSemestre->getSemestre() === $this) {
                $userSemestre->setSemestre(null);
            }
        }

        return $this;
    }
}
