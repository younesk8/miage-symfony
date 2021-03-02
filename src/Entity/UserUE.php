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
     * @ORM\ManyToOne(targetEntity=UE::class, inversedBy="userUEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UE;

    /**
     * @ORM\ManyToOne(targetEntity=UserModule::class, inversedBy="userUEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_Module;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserModule(): ?UserModule
    {
        return $this->user_Module;
    }

    public function setUserModule(?UserModule $user_Module): self
    {
        $this->user_Module = $user_Module;

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
