<?php

namespace App\Entity\UserMgr;

use App\Entity\CVsMgr\CV;
use App\Repository\UserMgr\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SApp\Repository\UserMgr\StudentRepository::class)
 */
class Student extends User
{
    /**
     * @Groups("student")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=CV::class, mappedBy="student")
     */
    private $cv;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    public function __construct($username)
    {
        parent::__construct($username);
        $this->cv = new ArrayCollection();
        $this->state = StudentState::WaitingValidation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoles()
    {
        $roles = $this->rol;
        $roles[] = 'ROLE_STUDENT';
        return $roles;
    }

    /**
     * @return Collection|CV[]
     */
    public function getCv(): Collection
    {
        return $this->cv;
    }

    public function addCv(CV $cv): self
    {
        if (!$this->cv->contains($cv)) {
            $this->cv[] = $cv;
            $cv->setStudent($this);
        }

        return $this;
    }

    public function removeCv(CV $cv): self
    {
        if ($this->cv->removeElement($cv)) {
            // set the owning side to null (unless already changed)
            if ($cv->getStudent() === $this) {
                $cv->setStudent(null);
            }
        }

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }
}
