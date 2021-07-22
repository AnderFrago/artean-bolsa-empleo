<?php

namespace App\Entity\UserMgr;

use App\Entity\OffersMgr\Offer;
use App\Repository\UserMgr\EmployerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=App\Repository\UserMgr\EmployerRepository::class)
 */
class Employer extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Offer::class, mappedBy="employer", orphanRemoval=true)
     */
    private $offers;

    /**
     * @ORM\Column(type="integer")
     */
    private $state;

    public function __construct($username)
    {
        parent::__construct($username);
        $this->offers = new ArrayCollection();
        $this->state = EmployerState::WaitingValidation;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getRoles()
    {
        $roles = $this->rol;
        $roles[] = 'ROLE_EMPLOYER';
        return $roles;
    }

    /**
     * @return Collection|Offer[]
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setEmployer($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getEmployer() === $this) {
                $offer->setEmployer(null);
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
