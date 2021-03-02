<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UERepository::class)
 */
class UE
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
    private $coef;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="uEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\OneToMany(targetEntity=UserUE::class, mappedBy="UE")
     */
    private $userUEs;

    public function __construct()
    {
        $this->userUEs = new ArrayCollection();
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

    public function getCoef(): ?int
    {
        return $this->coef;
    }

    public function setCoef(int $coef): self
    {
        $this->coef = $coef;

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

    /**
     * @return Collection|UserUE[]
     */
    public function getUserUEs(): Collection
    {
        return $this->userUEs;
    }

    public function addUserUE(UserUE $userUE): self
    {
        if (!$this->userUEs->contains($userUE)) {
            $this->userUEs[] = $userUE;
            $userUE->setUE($this);
        }

        return $this;
    }

    public function removeUserUE(UserUE $userUE): self
    {
        if ($this->userUEs->removeElement($userUE)) {
            // set the owning side to null (unless already changed)
            if ($userUE->getUE() === $this) {
                $userUE->setUE(null);
            }
        }

        return $this;
    }
}
