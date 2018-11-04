<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonalDataRepository")
 */
class PersonalData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FamilyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $BirthDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BirthPlace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="personalData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Membership", mappedBy="Person")
     */
    private $memberships;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adres", mappedBy="User", orphanRemoval=true)
     */
    private $adres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emails", mappedBy="User", orphanRemoval=true)
     */
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhoneNumbers", mappedBy="User", orphanRemoval=true)
     */
    private $phoneNumbers;

    public function __construct()
    {
        $this->memberships = new ArrayCollection();
        $this->adres = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setBirthDate(?\DateTimeInterface $BirthDate): self
    {
        $this->BirthDate = $BirthDate;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->BirthPlace;
    }

    public function setBirthPlace(?string $BirthPlace): self
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

    public function getUserID(): ?User
    {
        return $this->UserID;
    }

    public function setUserID(User $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    /**
     * @return Collection|Membership[]
     */
    public function getMemberships(): Collection
    {
        return $this->memberships;
    }

    public function addMembership(Membership $membership): self
    {
        if (!$this->memberships->contains($membership)) {
            $this->memberships[] = $membership;
            $membership->setPerson($this);
        }

        return $this;
    }

    public function removeMembership(Membership $membership): self
    {
        if ($this->memberships->contains($membership)) {
            $this->memberships->removeElement($membership);
            // set the owning side to null (unless already changed)
            if ($membership->getPerson() === $this) {
                $membership->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adres[]
     */
    public function getAdres(): Collection
    {
        return $this->adres;
    }

    public function addAdre(Adres $adre): self
    {
        if (!$this->adres->contains($adre)) {
            $this->adres[] = $adre;
            $adre->setUser($this);
        }

        return $this;
    }

    public function removeAdre(Adres $adre): self
    {
        if ($this->adres->contains($adre)) {
            $this->adres->removeElement($adre);
            // set the owning side to null (unless already changed)
            if ($adre->getUser() === $this) {
                $adre->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Emails[]
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Emails $email): self
    {
        if (!$this->emails->contains($email)) {
            $this->emails[] = $email;
            $email->setUser($this);
        }

        return $this;
    }

    public function removeEmail(Emails $email): self
    {
        if ($this->emails->contains($email)) {
            $this->emails->removeElement($email);
            // set the owning side to null (unless already changed)
            if ($email->getUser() === $this) {
                $email->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PhoneNumbers[]
     */
    public function getPhoneNumbers(): Collection
    {
        return $this->phoneNumbers;
    }

    public function addPhoneNumber(PhoneNumbers $phoneNumber): self
    {
        if (!$this->phoneNumbers->contains($phoneNumber)) {
            $this->phoneNumbers[] = $phoneNumber;
            $phoneNumber->setUser($this);
        }

        return $this;
    }

    public function removePhoneNumber(PhoneNumbers $phoneNumber): self
    {
        if ($this->phoneNumbers->contains($phoneNumber)) {
            $this->phoneNumbers->removeElement($phoneNumber);
            // set the owning side to null (unless already changed)
            if ($phoneNumber->getUser() === $this) {
                $phoneNumber->setUser(null);
            }
        }

        return $this;
    }
}
