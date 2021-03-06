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
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="responsablePole")
     */
    private $responsable;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="pole")
     */
    private $diplomes;

    public function __construct()
    {
        $this->responsable = new ArrayCollection();
        $this->diplomes = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getResponsable(): Collection
    {
        return $this->responsable;
    }

    public function addResponsable(User $responsable): self
    {
        if (!$this->responsable->contains($responsable)) {
            $this->responsable[] = $responsable;
            $responsable->setResponsablePole($this);
        }

        return $this;
    }

    public function removeResponsable(User $responsable): self
    {
        if ($this->responsable->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getResponsablePole() === $this) {
                $responsable->setResponsablePole(null);
            }
        }

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
}
