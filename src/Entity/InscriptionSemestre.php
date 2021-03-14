<?php

namespace App\Entity;

use App\Repository\InscriptionSemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=InscriptionSemestreRepository::class)
 * @ApiResource()
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
    private $anneeScolaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asTierTemp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asRSE;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $asValide;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asTransmise;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $messageProf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regime;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="inscriptionSemestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

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

    public function getAnneeScolaire(): ?string
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(string $anneeScolaire): self
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    public function getAsTierTemp(): ?bool
    {
        return $this->asTierTemp;
    }

    public function setAsTierTemp(bool $asTierTemp): self
    {
        $this->asTierTemp = $asTierTemp;

        return $this;
    }

    public function getAsRSE(): ?bool
    {
        return $this->asRSE;
    }

    public function setAsRSE(bool $asRSE): self
    {
        $this->asRSE = $asRSE;

        return $this;
    }

    public function getAsValide(): ?bool
    {
        return $this->asValide;
    }

    public function setAsValide(?bool $asValide): self
    {
        $this->asValide = $asValide;

        return $this;
    }

    public function getAsTransmise(): ?bool
    {
        return $this->asTransmise;
    }

    public function setAsTransmise(bool $asTransmise): self
    {
        $this->asTransmise = $asTransmise;

        return $this;
    }

    public function getMessageProf(): ?string
    {
        return $this->messageProf;
    }

    public function setMessageProf(?string $messageProf): self
    {
        $this->messageProf = $messageProf;

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

    public function getEtudiant(): ?User
    {
        return $this->etudiant;
    }

    public function setEtudiant(?User $etudiant): self
    {
        $this->etudiant = $etudiant;

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
