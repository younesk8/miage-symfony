<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiplomeRepository::class)
 */
class Diplome
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
     * @ORM\ManyToOne(targetEntity=Filliere::class, inversedBy="diplomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $filiere;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="diplome")
     */
    private $niveaux;

    /**
     * @ORM\OneToMany(targetEntity=ResponsableDiplome::class, mappedBy="diplome")
     */
    private $responsableDiplomes;

    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
        $this->responsableDiplomes = new ArrayCollection();
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

    public function getFiliere(): ?Filliere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filliere $filiere): self
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setDiplome($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getDiplome() === $this) {
                $niveau->setDiplome(null);
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
            $responsableDiplome->setDiplome($this);
        }

        return $this;
    }

    public function removeResponsableDiplome(ResponsableDiplome $responsableDiplome): self
    {
        if ($this->responsableDiplomes->removeElement($responsableDiplome)) {
            // set the owning side to null (unless already changed)
            if ($responsableDiplome->getDiplome() === $this) {
                $responsableDiplome->setDiplome(null);
            }
        }

        return $this;
    }
}
