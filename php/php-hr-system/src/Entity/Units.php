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

    public function getParentID(): ?string
    {
        return $this->parentID;
    }

    public function setParentID(?string $parentID): self
    {
        $this->parentID = $parentID;

        return $this;
    }

    public function getBossID(): ?string
    {
        return $this->BossID;
    }

    public function setBossID(string $BossID): self
    {
        $this->BossID = $BossID;

        return $this;
    }
}
