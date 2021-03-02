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
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity=InscriptionSemestre::class, inversedBy="propositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscription_Semestre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ajac;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInscriptionSemestre(): ?InscriptionSemestre
    {
        return $this->inscription_Semestre;
    }

    public function setInscriptionSemestre(?InscriptionSemestre $inscription_Semestre): self
    {
        $this->inscription_Semestre = $inscription_Semestre;

        return $this;
    }

    public function getAjac(): ?bool
    {
        return $this->ajac;
    }

    public function setAjac(bool $ajac): self
    {
        $this->ajac = $ajac;

        return $this;
    }
}
