<?php

namespace App\Entity\OffersMgr;

use App\Repository\OffersMgr\OfferRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
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
    private $company;

    /**
     * @ORM\Column(type="date")
     */
    private $due_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $minimumRequirements;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfApplyments;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->due_date;
    }

    public function setDueDate(\DateTimeInterface $due_date): self
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getMinimumRequirements(): ?string
    {
        return $this->minimumRequirements;
    }

    public function setMinimumRequirements(?string $minimumRequirements): self
    {
        $this->minimumRequirements = $minimumRequirements;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNumberOfApplyments(): ?int
    {
        return $this->numberOfApplyments;
    }

    public function setNumberOfApplyments(int $numberOfApplyments): self
    {
        $this->numberOfApplyments = $numberOfApplyments;

        return $this;
    }
}
