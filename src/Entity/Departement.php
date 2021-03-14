<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=DepartementRepository::class)
 * @ApiResource()
 */
class Departement
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
     * @ORM\ManyToOne(targetEntity=Ecole::class, inversedBy="departements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ecole;

    /**
     * @ORM\OneToMany(targetEntity=Pole::class, mappedBy="departement")
     */
    private $poles;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="departement")
     */
    private $responsables;

    public function __construct()
    {
        $this->poles = new ArrayCollection();
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

    public function getEcole(): ?Ecole
    {
        return $this->ecole;
    }

    public function setEcole(?Ecole $ecole): self
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * @return Collection|Pole[]
     */
    public function getPoles(): Collection
    {
        return $this->poles;
    }

    public function addPole(Pole $pole): self
    {
        if (!$this->poles->contains($pole)) {
            $this->poles[] = $pole;
            $pole->setDepartement($this);
        }

        return $this;
    }

    public function removePole(Pole $pole): self
    {
        if ($this->poles->removeElement($pole)) {
            // set the owning side to null (unless already changed)
            if ($pole->getDepartement() === $this) {
                $pole->setDepartement(null);
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
            $responsable->setDepartement($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getDepartement() === $this) {
                $responsable->setDepartement(null);
            }
        }

        return $this;
    }
}
