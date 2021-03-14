<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 * @ApiResource()
 */
class Parcours
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
     * @ORM\ManyToOne(targetEntity=Mention::class, inversedBy="parcours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mention;

    /**
     * @ORM\OneToMany(targetEntity=Responsable::class, mappedBy="parcours")
     */
    private $responsables;

    /**
     * @ORM\ManyToMany(targetEntity=Module::class, mappedBy="parcours")
     */
    private $modules;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="parcours")
     */
    private $promotions;

    /**
     * @ORM\OneToOne(targetEntity=DescriptionDiplome::class, cascade={"persist", "remove"})
     */
    private $description;

    public function __construct()
    {
        $this->responsables = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->promotions = new ArrayCollection();
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

    public function getMention(): ?Mention
    {
        return $this->mention;
    }

    public function setMention(?Mention $mention): self
    {
        $this->mention = $mention;

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
            $responsable->setParcours($this);
        }

        return $this;
    }

    public function removeResponsable(Responsable $responsable): self
    {
        if ($this->responsables->removeElement($responsable)) {
            // set the owning side to null (unless already changed)
            if ($responsable->getParcours() === $this) {
                $responsable->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Module[]
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->addParcour($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            $module->removeParcour($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setParcours($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getParcours() === $this) {
                $promotion->setParcours(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?DescriptionDiplome
    {
        return $this->description;
    }

    public function setDescription(?DescriptionDiplome $description): self
    {
        $this->description = $description;

        return $this;
    }
}