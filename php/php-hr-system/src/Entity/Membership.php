<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembershipRepository")
 */
class Membership
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
    private $PersonID;

    /**
     * @ORM\Column(type="integer")
     */
    private $UnitID;

    /**
     * @ORM\Column(type="integer")
     */
    private $WorkingHoursWeekly;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonID(): ?int
    {
        return $this->PersonID;
    }

    public function setPersonID(int $PersonID): self
    {
        $this->PersonID = $PersonID;

        return $this;
    }

    public function getUnitID(): ?int
    {
        return $this->UnitID;
    }

    public function setUnitID(int $UnitID): self
    {
        $this->UnitID = $UnitID;

        return $this;
    }

    public function getWorkingHoursWeekly(): ?int
    {
        return $this->WorkingHoursWeekly;
    }

    public function setWorkingHoursWeekly(int $WorkingHoursWeekly): self
    {
        $this->WorkingHoursWeekly = $WorkingHoursWeekly;

        return $this;
    }
}
