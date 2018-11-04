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
     * @ORM\OneToOne(targetEntity="App\Entity\PersonalData", inversedBy="jobData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\Column(type="date")
     */
    private $StartContract;

    /**
     * @ORM\Column(type="date")
     */
    private $EndContract;

    /**
     * @ORM\Column(type="integer")
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?PersonalData
    {
        return $this->User;
    }

    public function setUser(PersonalData $User): self
    {
        $this->User = $User;

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

    public function getMonthlySalary(): ?int
    {
        return $this->MonthlySalary;
    }

    public function setMonthlySalary(int $MonthlySalary): self
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
}
