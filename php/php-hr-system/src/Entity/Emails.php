<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as MyAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmailsRepository")
 * @MyAssert\ConstraintPrimary
 */
class Emails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prim;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $Value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalData", inversedBy="emails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrim(): ?bool
    {
        return $this->prim;
    }

    public function setPrim(bool $prim): self
    {
        $this->prim = $prim;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->Value;
    }

    public function setValue(string $Value): self
    {
        $this->Value = $Value;

        return $this;
    }

    public function getUser(): ?PersonalData
    {
        return $this->User;
    }

    public function setUser(?PersonalData $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->getUser()->getFirstName();
    }

    public function getFamilyName(): ?string
    {
        return $this->getUser()->getFamilyName();
    }

    public function toArray(): ?array
    {
        $ret = array();
        $ret["id"] = $this->getId();
        $ret["username"] = $this->getUser()->getUserID()->getUsername();
        $ret["prim"] = $this->getPrim();
        $ret["value"] = $this->getValue();
        return $ret;
    }

}
