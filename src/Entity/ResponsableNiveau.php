<?php

namespace App\Entity;

use App\Repository\ResponsableNiveauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponsableNiveauRepository::class)
 */
class ResponsableNiveau
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
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="responsableNiveaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Niveau;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="responsableNiveaux")
     * @ORM\JoinColumn(nullable=false)
     */
    private $responsable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->Niveau;
    }

    public function setNiveau(?Niveau $Niveau): self
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getResponsable(): ?User
    {
        return $this->responsable;
    }

    public function setResponsable(?User $responsable): self
    {
        $this->responsable = $responsable;

        return $this;
    }
}
