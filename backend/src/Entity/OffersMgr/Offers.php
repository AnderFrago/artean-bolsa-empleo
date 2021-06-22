<?php

namespace App\Entity\OffersMgr;

use App\Repository\OffersMgr\OffersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffersRepository::class)
 */
class Offers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OfferCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $OfferType;

    /**
     * @ORM\Column(type="date")
     */
    private $ActivationDate;

    /**
     * @ORM\Column(type="date")
     */
    private $DueDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Position;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="text")
     */
    private $Duties;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ExperienceRequirements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Salary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Location;

  
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creation_user;

    /**
     * @ORM\Column(type="date")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="date")
     */
    private $modification_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modification_user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferCode(): ?string
    {
        return $this->OfferCode;
    }

    public function setOfferCode(string $OfferCode): self
    {
        $this->OfferCode = $OfferCode;

        return $this;
    }

    public function getOfferType(): ?string
    {
        return $this->OfferType;
    }

    public function setOfferType(string $OfferType): self
    {
        $this->OfferType = $OfferType;

        return $this;
    }

    public function getActivationDate(): ?\DateTimeInterface
    {
        return $this->ActivationDate;
    }

    public function setActivationDate(\DateTimeInterface $ActivationDate): self
    {
        $this->ActivationDate = $ActivationDate;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->DueDate;
    }

    public function setDueDate(\DateTimeInterface $DueDate): self
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->Position;
    }

    public function setPosition(string $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDuties(): ?string
    {
        return $this->Duties;
    }

    public function setDuties(string $Duties): self
    {
        $this->Duties = $Duties;

        return $this;
    }

    public function getExperienceRequirements(): ?string
    {
        return $this->ExperienceRequirements;
    }

    public function setExperienceRequirements(string $ExperienceRequirements): self
    {
        $this->ExperienceRequirements = $ExperienceRequirements;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->Salary;
    }

    public function setSalary(string $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }


    public function getCreationUser(): ?string
    {
        return $this->creation_user;
    }

    public function setCreationUser(string $creation_user): self
    {
        $this->creation_user = $creation_user;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getModificationDate(): ?\DateTimeInterface
    {
        return $this->modification_date;
    }

    public function setModificationDate(\DateTimeInterface $modification_date): self
    {
        $this->modification_date = $modification_date;

        return $this;
    }

    public function getModificationUser(): ?string
    {
        return $this->modification_user;
    }

    public function setModificationUser(string $modification_user): self
    {
        $this->modification_user = $modification_user;

        return $this;
    }
}
