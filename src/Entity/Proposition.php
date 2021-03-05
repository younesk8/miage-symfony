<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropositionRepository::class)
 */
class Proposition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InscriptionSemestre::class, inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptionSemestre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asAjac;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInscriptionSemestre(): ?InscriptionSemestre
    {
        return $this->inscriptionSemestre;
    }

    public function setInscriptionSemestre(?InscriptionSemestre $inscriptionSemestre): self
    {
        $this->inscriptionSemestre = $inscriptionSemestre;

        return $this;
    }

    public function getAsAjac(): ?bool
    {
        return $this->asAjac;
    }

    public function setAsAjac(bool $asAjac): self
    {
        $this->asAjac = $asAjac;

        return $this;
    }
}
