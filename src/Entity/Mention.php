<?php

namespace App\Entity;

use App\Repository\MentionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=MentionRepository::class)
 * @ApiResource()
 */
class Mention
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
     * @ORM\ManyToOne(targetEntity=Diplome::class, inversedBy="mentions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diplome;

    /**
     * @ORM\OneToMany(targetEntity=Semestre::class, mappedBy="mention")
     */
    private $semestres;

    /**
     * @ORM\OneToMany(targetEntity=Parcours::class, mappedBy="mention")
     */
    private $parcours;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="mention")
     */
    private $promotions;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="mention")
     */
    private $responsables;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
        $this->parcours = new ArrayCollection();
        $this->promotions = new ArrayCollection();
        $this->responsables = new ArrayCollection();
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
            $semestre->setMention($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getMention() === $this) {
                $semestre->setMention(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parcours[]
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcours $parcour): self
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours[] = $parcour;
            $parcour->setMention($this);
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): self
    {
        if ($this->parcours->removeElement($parcour)) {
            // set the owning side to null (unless already changed)
            if ($parcour->getMention() === $this) {
                $parcour->setMention(null);
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
            $promotion->setMention($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getMention() === $this) {
                $promotion->setMention(null);
            }
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
            $responsable->setMention($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getMention() === $this) {
                $responsable->setMention(null);
            }
        }

        return $this;
    }
}