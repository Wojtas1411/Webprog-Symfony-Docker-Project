<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parentID;

    /**
     * @ORM\Column(type="integer")
     */
    private $BossID;

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

    public function getParentID(): ?int
    {
        return $this->parentID;
    }

    public function setParentID(?int $parentID): self
    {
        $this->parentID = $parentID;

        return $this;
    }

    public function getBossID(): ?int
    {
        return $this->BossID;
    }

    public function setBossID(int $BossID): self
    {
        $this->BossID = $BossID;

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
}
