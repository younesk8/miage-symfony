<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
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
     * @ORM\ManyToOne(targetEntity=Diplome::class, inversedBy="niveaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diplome;

    /**
     * @ORM\OneToMany(targetEntity=Semestre::class, mappedBy="niveau")
     */
    private $semestres;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="niveau")
     */
    private $promotions;

    /**
     * @ORM\OneToMany(targetEntity=ResponsableNiveau::class, mappedBy="Niveau")
     */
    private $responsableNiveaux;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->promotions = new ArrayCollection();
        $this->responsableNiveaux = new ArrayCollection();
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

    public function getDiplome(): ?Diplome
    {
        return $this->diplome;
    }

    public function setDiplome(?Diplome $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * @return Collection|Semestre[]
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    public function addSemestre(Semestre $semestre): self
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres[] = $semestre;
            $semestre->setNiveau($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getNiveau() === $this) {
                $semestre->setNiveau(null);
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
            $promotion->setNiveau($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getNiveau() === $this) {
                $promotion->setNiveau(null);
            }
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
            $responsableNiveau->setNiveau($this);
        }

        return $this;
    }

    public function removeResponsableNiveau(ResponsableNiveau $responsableNiveau): self
    {
        if ($this->responsableNiveaux->removeElement($responsableNiveau)) {
            // set the owning side to null (unless already changed)
            if ($responsableNiveau->getNiveau() === $this) {
                $responsableNiveau->setNiveau(null);
            }
        }

        return $this;
    }
}
