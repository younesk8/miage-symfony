<?php

namespace App\Entity;

use App\Repository\PoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PoleRepository::class)
 */
class Pole
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
     * @ORM\ManyToOne(targetEntity=Departement::class, inversedBy="poles")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="pole")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="pole")
     */
    private $responsables;

    public function __construct()
    {
        $this->diplomes = new ArrayCollection();
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

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes[] = $diplome;
            $diplome->setPole($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->removeElement($diplome)) {
            // set the owning side to null (unless already changed)
            if ($diplome->getPole() === $this) {
                $diplome->setPole(null);
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
            $responsable->setPole($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getPole() === $this) {
                $responsable->setPole(null);
            }
        }

        return $this;
    }
}
