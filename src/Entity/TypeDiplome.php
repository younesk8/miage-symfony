<?php

namespace App\Entity;

use App\Repository\TypeDiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeDiplomeRepository::class)
 */
class TypeDiplome
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
    private $nbAnnee;

    /**
     * @ORM\OneToMany(targetEntity=Diplome::class, mappedBy="typeDiplome")
     */
    private $diplomes;

    public function __construct()
    {
        $this->diplomes = new ArrayCollection();
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

    public function getNbAnnee(): ?int
    {
        return $this->nbAnnee;
    }

    public function setNbAnnee(int $nbAnnee): self
    {
        $this->nbAnnee = $nbAnnee;

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes[] = $diplome;
            $diplome->setTypeDiplome($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->removeElement($diplome)) {
            // set the owning side to null (unless already changed)
            if ($diplome->getTypeDiplome() === $this) {
                $diplome->setTypeDiplome(null);
            }
        }

        return $this;
    }
}
