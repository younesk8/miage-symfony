<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SemestreRepository::class)
 */
class Semestre
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
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="semestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Mention::class, inversedBy="semestres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mention;

    /**
     * @ORM\OneToMany(targetEntity=UserSemestre::class, mappedBy="semestre")
     */
    private $userSemestres;

    /**
     * @ORM\OneToMany(targetEntity=UE::class, mappedBy="semestre")
     */
    private $uEs;

    public function __construct()
    {
        $this->userSemestres = new ArrayCollection();
        $this->uEs = new ArrayCollection();
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

    public function getAnnee(): ?Annee
    {
        return $this->annee;
    }

    public function setAnnee(?Annee $annee): self
    {
        $this->annee = $annee;

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
     * @return Collection|UserSemestre[]
     */
    public function getUserSemestres(): Collection
    {
        return $this->userSemestres;
    }

    public function addUserSemestre(UserSemestre $userSemestre): self
    {
        if (!$this->userSemestres->contains($userSemestre)) {
            $this->userSemestres[] = $userSemestre;
            $userSemestre->setSemestre($this);
        }

        return $this;
    }

    public function removeUserSemestre(UserSemestre $userSemestre): self
    {
        if ($this->userSemestres->removeElement($userSemestre)) {
            // set the owning side to null (unless already changed)
            if ($userSemestre->getSemestre() === $this) {
                $userSemestre->setSemestre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UE[]
     */
    public function getUEs(): Collection
    {
        return $this->uEs;
    }

    public function addUE(UE $uE): self
    {
        if (!$this->uEs->contains($uE)) {
            $this->uEs[] = $uE;
            $uE->setSemestre($this);
        }

        return $this;
    }

    public function removeUE(UE $uE): self
    {
        if ($this->uEs->removeElement($uE)) {
            // set the owning side to null (unless already changed)
            if ($uE->getSemestre() === $this) {
                $uE->setSemestre(null);
            }
        }

        return $this;
    }
}
