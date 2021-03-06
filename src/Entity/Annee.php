<?php

namespace App\Entity;

use App\Repository\AnneeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnneeRepository::class)
 */
class Annee
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
    private $numeroAnnee;

    /**
     * @ORM\ManyToOne(targetEntity=Diplome::class, inversedBy="annees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diplome;

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

    public function getNumeroAnnee(): ?int
    {
        return $this->numeroAnnee;
    }

    public function setNumeroAnnee(int $numeroAnnee): self
    {
        $this->numeroAnnee = $numeroAnnee;

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
}
