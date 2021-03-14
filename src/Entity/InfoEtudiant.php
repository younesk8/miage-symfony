<?php

namespace App\Entity;

use App\Repository\InfoEtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=InfoEtudiantRepository::class)
 * @ApiResource()
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
    private $numEtu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $regimeSpecial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseEtu;

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
        return $this->numEtu;
    }

    public function setNumEtu(string $numEtu): self
    {
        $this->numEtu = $numEtu;

        return $this;
    }

    public function getRegimeSpecial(): ?string
    {
        return $this->regimeSpecial;
    }

    public function setRegimeSpecial(?string $regimeSpecial): self
    {
        $this->regimeSpecial = $regimeSpecial;

        return $this;
    }

    public function getAdresseEtu(): ?string
    {
        return $this->adresseEtu;
    }

    public function setAdresseEtu(?string $adresseEtu): self
    {
        $this->adresseEtu = $adresseEtu;

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
