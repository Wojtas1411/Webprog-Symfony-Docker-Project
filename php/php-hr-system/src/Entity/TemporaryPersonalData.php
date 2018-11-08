<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemporaryPersonalDataRepository")
 */
class TemporaryPersonalData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Timestamp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FamilyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="date")
     */
    private $BirthDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BirthPlace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $adres = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $emails = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $phoneNumbers = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->Timestamp;
    }

    public function setTimestamp(\DateTimeInterface $Timestamp): self
    {
        $this->Timestamp = $Timestamp;

        return $this;
    }

    public function getUserID(): ?string
    {
        return $this->UserID;
    }

    public function setUserID(string $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->FamilyName;
    }

    public function setFamilyName(string $FamilyName): self
    {
        $this->FamilyName = $FamilyName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->BirthDate;
    }

    public function setBirthDate(\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->BirthPlace;
    }

    public function setBirthPlace(string $BirthPlace): self
    {
        $this->BirthPlace = $BirthPlace;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(?string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getAdres(): ?array
    {
        return $this->adres;
    }

    public function setAdres(?array $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getEmails(): ?array
    {
        return $this->emails;
    }

    public function setEmails(?array $emails): self
    {
        $this->emails = $emails;

        return $this;
    }

    public function getPhoneNumbers(): ?array
    {
        return $this->phoneNumbers;
    }

    public function setPhoneNumbers(?array $phoneNumbers): self
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }
}
