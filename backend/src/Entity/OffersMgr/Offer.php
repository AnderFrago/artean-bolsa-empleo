<?php

namespace App\Entity\OffersMgr;

use App\Entity\UserMgr\Employer;
use App\Repository\OffersMgr\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=App\Repository\OffersMgr\OfferRepository::class)
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
     * @Groups("offer")
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @Groups("offer")
     * @ORM\Column(type="date")
     */
    private $due_date;

    /**
     * @Groups("offer")
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @Groups("offer")
     * @ORM\Column(type="text", nullable=true)
     */
    private $minimumRequirements;

    /**
     * @Groups("offer")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Groups("offer")
     * @ORM\Column(type="integer")
     */
    private $numberOfApplyments;

    /**
     * @ORM\ManyToOne(targetEntity=Employer::class, inversedBy="offers")
     */
    private $employer;

    /**
     * @ORM\OneToMany(targetEntity=Applyments::class, mappedBy="offer")
     */
    private $applyments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileNam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filePath;



    public function __construct()
    {
        $this->applyments = new ArrayCollection();
    }

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

    public function getEmployer(): ?Employer
    {
        return $this->employer;
    }

    public function setEmployer(?Employer $employer): self
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * @return Collection|Applyments[]
     */
    public function getApplyments(): Collection
    {
        return $this->applyments;
    }

    public function addApplyment(Applyments $applyment): self
    {
        if (!$this->applyments->contains($applyment)) {
            $this->applyments[] = $applyment;
            $applyment->setOffer($this);
        }

        return $this;
    }

    public function removeApplyment(Applyments $applyment): self
    {
        if ($this->applyments->removeElement($applyment)) {
            // set the owning side to null (unless already changed)
            if ($applyment->getOffer() === $this) {
                $applyment->setOffer(null);
            }
        }

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getFileNam(): ?string
    {
        return $this->fileNam;
    }

    public function setFileNam(string $fileNam): self
    {
        $this->fileNam = $fileNam;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function setNumberOfApplyments(int $int)
    {
        $this->numberOfApplyments = $int;
    }


}
