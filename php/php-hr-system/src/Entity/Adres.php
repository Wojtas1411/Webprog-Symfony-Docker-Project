<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresRepository")
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
     * @ORM\Column(type="integer")
     */
    private $OwnerID;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prim;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Number;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Local;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PostalCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Town;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerID(): ?int
    {
        return $this->OwnerID;
    }

    public function setOwnerID(int $OwnerID): self
    {
        $this->OwnerID = $OwnerID;

        return $this;
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
}