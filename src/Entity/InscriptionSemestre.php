<?php

namespace App\Entity;

use App\Repository\InscriptionSemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionSemestreRepository::class)
 */
class InscriptionSemestre
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
     * @ORM\Column(type="boolean")
     */
    private $tier_Temp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $RSE;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $Valide;

    /**
     * @ORM\Column(type="boolean")
     */
    private $transmise;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message_Prof;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regime;

    /**
     * @ORM\ManyToOne(targetEntity=Semestre::class, inversedBy="inscriptionSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestre;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptionSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudient;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptionSemestres")
     */
    private $secretaire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptionSemestres")
     */
    private $enseignant;

    /**
     * @ORM\OneToMany(targetEntity=Proposition::class, mappedBy="inscription_Semestre")
     */
    private $propositions;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
    }

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

    public function getTierTemp(): ?bool
    {
        return $this->tier_Temp;
    }

    public function setTierTemp(bool $tier_Temp): self
    {
        $this->tier_Temp = $tier_Temp;

        return $this;
    }

    public function getRSE(): ?bool
    {
        return $this->RSE;
    }

    public function setRSE(bool $RSE): self
    {
        $this->RSE = $RSE;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->Valide;
    }

    public function setValide(?bool $Valide): self
    {
        $this->Valide = $Valide;

        return $this;
    }

    public function getTransmise(): ?bool
    {
        return $this->transmise;
    }

    public function setTransmise(bool $transmise): self
    {
        $this->transmise = $transmise;

        return $this;
    }

    public function getMessageProf(): ?string
    {
        return $this->message_Prof;
    }

    public function setMessageProf(?string $message_Prof): self
    {
        $this->message_Prof = $message_Prof;

        return $this;
    }

    public function getRegime(): ?string
    {
        return $this->regime;
    }

    public function setRegime(?string $regime): self
    {
        $this->regime = $regime;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getEtudient(): ?User
    {
        return $this->etudient;
    }

    public function setEtudient(?User $etudient): self
    {
        $this->etudient = $etudient;

        return $this;
    }

    public function getSecretaire(): ?User
    {
        return $this->secretaire;
    }

    public function setSecretaire(?User $secretaire): self
    {
        $this->secretaire = $secretaire;

        return $this;
    }

    public function getEnseignant(): ?User
    {
        return $this->enseignant;
    }

    public function setEnseignant(?User $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setInscriptionSemestre($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getInscriptionSemestre() === $this) {
                $proposition->setInscriptionSemestre(null);
            }
        }

        return $this;
    }
}
