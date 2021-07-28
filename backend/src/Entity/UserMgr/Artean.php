<?php

namespace App\Entity\UserMgr;

use App\Repository\UserMgr\ArteanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArteanRepository::class)
 */
class Artean extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function __construct($username)
    {
        parent::__construct($username);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles()
    {
        $roles = $this->rol;
        $roles[] = 'ROLE_ARTEAN';
        return $roles;
    }

    public function getState(): ?int
    {
        return 1;
    }

}
