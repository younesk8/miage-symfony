<?php

namespace App\Entity;

use App\Repository\InfoEtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InfoEtudiantRepository::class)
 */
class InfoEtudiant
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
    private $num_etu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regime_special;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse_etu;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="infoEtudiant", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEtu(): ?string
    {
        return $this->num_etu;
    }

    public function setNumEtu(string $num_etu): self
    {
        $this->num_etu = $num_etu;

        return $this;
    }

    public function getRegimeSpecial(): ?string
    {
        return $this->regime_special;
    }

    public function setRegimeSpecial(?string $regime_special): self
    {
        $this->regime_special = $regime_special;

        return $this;
    }

    public function getAdresseEtu(): ?string
    {
        return $this->adresse_etu;
    }

    public function setAdresseEtu(?string $adresse_etu): self
    {
        $this->adresse_etu = $adresse_etu;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
