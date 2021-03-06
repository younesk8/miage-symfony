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
     * @ORM\Column(type="integer")
     */
    private $nbAnnee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveauDiplome;

    /**
     * @ORM\ManyToOne(targetEntity=Pole::class, inversedBy="diplomes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pole;

    /**
     * @ORM\OneToMany(targetEntity=Annee::class, mappedBy="diplome")
     */
    private $annees;

    public function __construct()
    {
        $this->annees = new ArrayCollection();
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

    public function getNbAnnee(): ?int
    {
        return $this->nbAnnee;
    }

    public function setNbAnnee(int $nbAnnee): self
    {
        $this->nbAnnee = $nbAnnee;

        return $this;
    }

    public function getNiveauDiplome(): ?string
    {
        return $this->niveauDiplome;
    }

    public function setNiveauDiplome(string $niveauDiplome): self
    {
        $this->niveauDiplome = $niveauDiplome;

        return $this;
    }

    public function getPole(): ?Pole
    {
        return $this->pole;
    }

    public function setPole(?Pole $pole): self
    {
        $this->pole = $pole;

        return $this;
    }

    /**
     * @return Collection|Annee[]
     */
    public function getAnnees(): Collection
    {
        return $this->annees;
    }

    public function addAnnee(Annee $annee): self
    {
        if (!$this->annees->contains($annee)) {
            $this->annees[] = $annee;
            $annee->setDiplome($this);
        }

        return $this;
    }

    public function removeAnnee(Annee $annee): self
    {
        if ($this->annees->removeElement($annee)) {
            // set the owning side to null (unless already changed)
            if ($annee->getDiplome() === $this) {
                $annee->setDiplome(null);
            }
        }

        return $this;
    }
}
