<?php

namespace App\Entity;

use App\Repository\UserModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=UserModuleRepository::class)
 * @ApiResource()
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
     * @ORM\ManyToOne(targetEntity=UserUE::class, inversedBy="userModules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userUE;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="userModules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

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

    public function getUserUE(): ?UserUE
    {
        return $this->userUE;
    }

    public function setUserUE(?UserUE $userUE): self
    {
        $this->userUE = $userUE;

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

}
