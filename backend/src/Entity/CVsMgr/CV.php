<?php

namespace App\Entity\CVsMgr;

use App\Entity\OffersMgr\Applyments;
use App\Entity\UserMgr\Student;
use App\Repository\CVsMgr\CVRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CVRepository::class)
 */
class CV
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
    private $originalName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pathName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $txtPath;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="cv")
     */
    private $student;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textcv;

    /**
     * @ORM\OneToMany(targetEntity=Applyments::class, mappedBy="cv")
     */
    private $applyments;


    public function __construct()
    {
        $this->applyments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getPathName(): ?string
    {
        return $this->pathName;
    }

    public function setPathName(string $pathName): self
    {
        $this->pathName = $pathName;

        return $this;
    }

    public function getTxtPath(): ?string
    {
        return $this->txtPath;
    }

    public function setTxtPath(string $txtPath): self
    {
        $this->txtPath = $txtPath;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }



    public function getTextcv(): ?string
    {
        return $this->textcv;
    }

    public function setTextcv(?string $textcv): self
    {
        $this->textcv = $textcv;

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
            $applyment->setCv($this);
        }

        return $this;
    }

    public function removeApplyment(Applyments $applyment): self
    {
        if ($this->applyments->removeElement($applyment)) {
            // set the owning side to null (unless already changed)
            if ($applyment->getCv() === $this) {
                $applyment->setCv(null);
            }
        }

        return $this;
    }


}
