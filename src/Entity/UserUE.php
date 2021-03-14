<?php

namespace App\Entity;

use App\Repository\UserUERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=UserUERepository::class)
 * @ApiResource()
 */
class UserUE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=UserSemestre::class, inversedBy="userUEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userSemestre;

    /**
     * @ORM\ManyToOne(targetEntity=UE::class, inversedBy="userUEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UE;

    /**
     * @ORM\OneToMany(targetEntity=UserModule::class, mappedBy="userUE")
     */
    private $userModules;

    public function __construct()
    {
        $this->userModules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $userModule->setUserUE($this);
        }

        return $this;
    }

    public function removeUserModule(UserModule $userModule): self
    {
        if ($this->userModules->removeElement($userModule)) {
            // set the owning side to null (unless already changed)
            if ($userModule->getUserUE() === $this) {
                $userModule->setUserUE(null);
            }
        }

        return $this;
    }
}
