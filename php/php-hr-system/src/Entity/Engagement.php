<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EngagementRepository")
 */
class Engagement
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
    private $StaffCategoryID;

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

    public function getStaffCategoryID(): ?int
    {
        return $this->StaffCategoryID;
    }

    public function setStaffCategoryID(int $StaffCategoryID): self
    {
        $this->StaffCategoryID = $StaffCategoryID;

        return $this;
    }
}
