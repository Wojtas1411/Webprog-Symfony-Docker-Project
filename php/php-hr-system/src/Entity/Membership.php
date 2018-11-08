<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use App\Validator\Constraints as MyAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembershipRepository")
 * @MyAssert\ConstraintWorkingHours
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
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalData", inversedBy="memberships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Person;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Units")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Unit;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *      min = 1,
     *      max = 40,
     *      minMessage = "Working Hours per week must be at least {{ limit }}",
     *      maxMessage = "Working Hours per week can be max {{ limit }}"
     * )
     */
    private $WorkingHoursPerWeek;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?PersonalData
    {
        return $this->Person;
    }

    public function setPerson(?PersonalData $Person): self
    {
        $this->Person = $Person;

        return $this;
    }

    public function getUnit(): ?Units
    {
        return $this->Unit;
    }

    public function setUnit(?Units $Unit): self
    {
        $this->Unit = $Unit;

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
}
