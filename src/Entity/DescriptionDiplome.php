<?php

namespace App\Entity;

use App\Repository\DescriptionDiplomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=DescriptionDiplomeRepository::class)
 * @ApiResource()
 */
class DescriptionDiplome
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionBref;

    /**
     * @ORM\Column(type="text")
     */
    private $publicConcerne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fichePDF;

    /**
     * @ORM\Column(type="text")
     */
    private $preRequis;

    /**
     * @ORM\Column(type="text")
     */
    private $modaliteInscription;

    /**
     * @ORM\Column(type="text")
     */
    private $tarif;

    /**
     * @ORM\Column(type="text")
     */
    private $competences;

    /**
     * @ORM\OneToOne(targetEntity=Mention::class, cascade={"persist", "remove"})
     */
    private $mention;

    /**
     * @ORM\Column(type="text")
     */
    private $poursuiteEtude;

    /**
     * @ORM\Column(type="text")
     */
    private $deboucherPro;

    /**
     * @ORM\Column(type="text")
     */
    private $contact;

    /**
     * @ORM\Column(type="text")
     */
    private $atouts;

    public function __construct()
    {
        $this->parcours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionBref(): ?string
    {
        return $this->descriptionBref;
    }

    public function setDescriptionBref(string $descriptionBref): self
    {
        $this->descriptionBref = $descriptionBref;

        return $this;
    }

    public function getPublicConcerne(): ?string
    {
        return $this->publicConcerne;
    }

    public function setPublicConcerne(string $publicConcerne): self
    {
        $this->publicConcerne = $publicConcerne;

        return $this;
    }

    public function getFichePDF(): ?string
    {
        return $this->fichePDF;
    }

    public function setFichePDF(string $fichePDF): self
    {
        $this->fichePDF = $fichePDF;

        return $this;
    }

    public function getPreRequis(): ?string
    {
        return $this->preRequis;
    }

    public function setPreRequis(string $preRequis): self
    {
        $this->preRequis = $preRequis;

        return $this;
    }

    public function getModaliteInscription(): ?string
    {
        return $this->modaliteInscription;
    }

    public function setModaliteInscription(string $modaliteInscription): self
    {
        $this->modaliteInscription = $modaliteInscription;

        return $this;
    }

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getCompetences(): ?string
    {
        return $this->competences;
    }

    public function setCompetences(string $competences): self
    {
        $this->competences = $competences;

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

    public function getPoursuiteEtude(): ?string
    {
        return $this->poursuiteEtude;
    }

    public function setPoursuiteEtude(string $poursuiteEtude): self
    {
        $this->poursuiteEtude = $poursuiteEtude;

        return $this;
    }

    public function getDeboucherPro(): ?string
    {
        return $this->deboucherPro;
    }

    public function setDeboucherPro(string $deboucherPro): self
    {
        $this->deboucherPro = $deboucherPro;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAtouts(): ?string
    {
        return $this->atouts;
    }

    public function setAtouts(string $atouts): self
    {
        $this->atouts = $atouts;

        return $this;
    }
}
