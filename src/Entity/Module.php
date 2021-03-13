<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModuleRepository::class)
 */
class Module
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
     * @ORM\Column(type="boolean")
     */
    private $asObligatoire;

    /**
     * @ORM\Column(type="integer")
     */
    private $ECTS;

    /**
     * @ORM\ManyToOne(targetEntity=UE::class, inversedBy="modules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UE;

    /**
     * @ORM\OneToMany(targetEntity=UserModule::class, mappedBy="module")
     */
    private $userModules;

    /**
     * @ORM\OneToMany(targetEntity=Proposition::class, mappedBy="module")
     */
    private $propositions;

    /**
     * @ORM\ManyToMany(targetEntity=Parcours::class, inversedBy="modules")
     */
    private $parcours;

    /**
     * @ORM\ManyToMany(targetEntity=Responsable::class, mappedBy="modules")
     */
    private $responsables;

    /**
     * @ORM\Column(type="integer")
     */
    private $coef;

    public function __construct()
    {
        $this->userModules = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->parcours = new ArrayCollection();
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

    public function getAsObligatoire(): ?bool
    {
        return $this->asObligatoire;
    }

    public function setAsObligatoire(bool $asObligatoire): self
    {
        $this->asObligatoire = $asObligatoire;

        return $this;
    }

    public function getECTS(): ?int
    {
        return $this->ECTS;
    }

    public function setECTS(int $ECTS): self
    {
        $this->ECTS = $ECTS;

        return $this;
    }

    public function getUE(): ?UE
    {
        return $this->UE;
    }

    public function setUE(?UE $UE): self
    {
        $this->UE = $UE;

        return $this;
    }

    /**
     * @return Collection|UserModule[]
     */
    public function getUserModules(): Collection
    {
        return $this->userModules;
    }

    public function addUserModule(UserModule $userModule): self
    {
        if (!$this->userModules->contains($userModule)) {
            $this->userModules[] = $userModule;
            $userModule->setModule($this);
        }

        return $this;
    }

    public function removeUserModule(UserModule $userModule): self
    {
        if ($this->userModules->removeElement($userModule)) {
            // set the owning side to null (unless already changed)
            if ($userModule->getModule() === $this) {
                $userModule->setModule(null);
            }
        }

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
            $proposition->setModule($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getModule() === $this) {
                $proposition->setModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Parcours[]
     */
    public function getParcours(): Collection
    {
        return $this->parcours;
    }

    public function addParcour(Parcours $parcour): self
    {
        if (!$this->parcours->contains($parcour)) {
            $this->parcours[] = $parcour;
        }

        return $this;
    }

    public function removeParcour(Parcours $parcour): self
    {
        $this->parcours->removeElement($parcour);

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
            $responsable->addModule($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            $responsable->removeModule($this);
        }

        return $this;
    }

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): self
    {
        $this->coef = $coef;

        return $this;
    }
}
