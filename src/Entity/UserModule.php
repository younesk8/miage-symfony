<?php

namespace App\Entity;

use App\Repository\UserModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserModuleRepository::class)
 */
class UserModule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asAjac;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $moyenne;

    /**
     * @ORM\ManyToOne(targetEntity=UserSemestre::class, inversedBy="userModules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userSemestre;

    /**
     * @ORM\OneToMany(targetEntity=UserUE::class, mappedBy="user_Module")
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

    public function getAsAjac(): ?bool
    {
        return $this->asAjac;
    }

    public function setAsAjac(bool $asAjac): self
    {
        $this->asAjac = $asAjac;

        return $this;
    }

    public function getMoyenne(): ?int
    {
        return $this->moyenne;
    }

    public function setMoyenne(?int $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function getUserSemestre(): ?UserSemestre
    {
        return $this->userSemestre;
    }

    public function setUserSemestre(?UserSemestre $userSemestre): self
    {
        $this->userSemestre = $userSemestre;

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
            $userUE->setUserModule($this);
        }

        return $this;
    }

    public function removeUserUE(UserUE $userUE): self
    {
        if ($this->userUEs->removeElement($userUE)) {
            // set the owning side to null (unless already changed)
            if ($userUE->getUserModule() === $this) {
                $userUE->setUserModule(null);
            }
        }

        return $this;
    }
}
