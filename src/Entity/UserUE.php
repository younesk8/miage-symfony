<?php

namespace App\Entity;

use App\Repository\UserUERepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserUERepository::class)
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
     * @ORM\ManyToOne(targetEntity=UserModule::class, inversedBy="userUEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userModule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserModule(): ?UserModule
    {
        return $this->userModule;
    }

    public function setUserModule(?UserModule $userModule): self
    {
        $this->userModule = $userModule;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
