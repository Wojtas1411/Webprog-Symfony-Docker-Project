<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresRepository")
 * @MyAssert\ConstraintPrimary
 */
class Adres
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prim;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[A-Za-z ]{2,}/")
     */
    private $Street;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9A-Za-z ]{1,}/")
     */
    private $Number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex("/^[0-9A-Za-z ]{1,}/")
     */
    private $Local;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9A-Za-z\- ]{3,10}/")
     */
    private $PostalCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[A-Za-z \-]{2,}/")
     */
    private $Town;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalData", inversedBy="adres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrim(): ?bool
    {
        return $this->prim;
    }

    public function setPrim(bool $prim): self
    {
        $this->prim = $prim;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->Street;
    }

    public function setStreet(string $Street): self
    {
        $this->Street = $Street;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getLocal(): ?string
    {
        return $this->Local;
    }

    public function setLocal(?string $Local): self
    {
        $this->Local = $Local;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->PostalCode;
    }

    public function setPostalCode(string $PostalCode): self
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->Town;
    }

    public function setTown(string $Town): self
    {
        $this->Town = $Town;

        return $this;
    }

    public function getUser(): ?PersonalData
    {
        return $this->User;
    }

    public function setUser(?PersonalData $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->getUser()->getFirstName();
    }

    public function getFamilyName(): ?string
    {
        return $this->getUser()->getFamilyName();
    }

    public function toArray(): ?array
    {
        $ret = array();
        $ret["id"] = $this->getId();
        $ret["username"] = $this->getUser()->getUserID()->getUsername();
        $ret["prim"] = $this->getPrim();
        $ret["street"] = $this->getStreet();
        $ret["number"] = $this->getNumber();
        $ret["local"] = $this->getLocal();
        $ret["postalCode"] = $this->getPostalCode();
        $ret["town"] = $this->getTown();
        return $ret;
    }
}
