<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobDataRepository")
 */
class JobData
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
     * @ORM\Column(type="date")
     */
    private $StartContract;

    /**
     * @ORM\Column(type="date")
     */
    private $EndContract;

    /**
     * @ORM\Column(type="float")
     */
    private $MonthlySalary;

    /**
     * @ORM\Column(type="integer")
     */
    private $WorkingHoursPerWeek;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BankInfo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $BankAccountNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PersonalData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserID;

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

    public function getStartContract(): ?\DateTimeInterface
    {
        return $this->StartContract;
    }

    public function setStartContract(\DateTimeInterface $StartContract): self
    {
        $this->StartContract = $StartContract;

        return $this;
    }

    public function getEndContract(): ?\DateTimeInterface
    {
        return $this->EndContract;
    }

    public function setEndContract(\DateTimeInterface $EndContract): self
    {
        $this->EndContract = $EndContract;

        return $this;
    }

    public function getMonthlySalary(): ?float
    {
        return $this->MonthlySalary;
    }

    public function setMonthlySalary(float $MonthlySalary): self
    {
        $this->MonthlySalary = $MonthlySalary;

        return $this;
    }

    public function getWorkingHoursPerWeek(): ?int
    {
        return $this->WorkingHoursPerWeek;
    }

    public function setWorkingHoursPerWeek(int $WorkingHoursPerWeek): self
    {
        $this->WorkingHoursPerWeek = $WorkingHoursPerWeek;

        return $this;
    }

    public function getBankInfo(): ?string
    {
        return $this->BankInfo;
    }

    public function setBankInfo(string $BankInfo): self
    {
        $this->BankInfo = $BankInfo;

        return $this;
    }

    public function getBankAccountNumber(): ?string
    {
        return $this->BankAccountNumber;
    }

    public function setBankAccountNumber(string $BankAccountNumber): self
    {
        $this->BankAccountNumber = $BankAccountNumber;

        return $this;
    }

    public function getUserID(): ?PersonalData
    {
        return $this->UserID;
    }

    public function setUserID(PersonalData $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }
}
