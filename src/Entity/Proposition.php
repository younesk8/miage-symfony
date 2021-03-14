<?php

namespace App\Entity;

use App\Repository\PropositionRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=PropositionRepository::class)
 * @ApiResource()
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

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

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

    public function getModule(): ?Module
    {
        return $this->module;
    }

    public function setModule(?Module $module): self
    {
        $this->module = $module;

        return $this;
    }
}
