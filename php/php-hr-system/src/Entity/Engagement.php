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
     * @ORM\ManyToOne(targetEntity="App\Entity\StaffCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StaffCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PersonalData", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaffCategory(): ?StaffCategory
    {
        return $this->StaffCategory;
    }

    public function setStaffCategory(?StaffCategory $StaffCategory): self
    {
        $this->StaffCategory = $StaffCategory;

        return $this;
    }

    public function getPerson(): ?PersonalData
    {
        return $this->Person;
    }

    public function setPerson(PersonalData $Person): self
    {
        $this->Person = $Person;

        return $this;
    }
}
