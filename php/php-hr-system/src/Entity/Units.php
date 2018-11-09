<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UnitsRepository")
 */
class Units
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[A-Za-z \-]{2,}/")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Units")
     */
    private $Parent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Boss;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->Parent;
    }

    public function setParent(?self $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    public function getBoss(): ?PersonalData
    {
        return $this->Boss;
    }

    public function setBoss(?PersonalData $Boss): self
    {
        $this->Boss = $Boss;

        return $this;
    }

    public function getParentName(): ?string
    {
        if($this->getParent() === null){
            return "None";
        }
        return $this->getParent()->getName();
    }
}
