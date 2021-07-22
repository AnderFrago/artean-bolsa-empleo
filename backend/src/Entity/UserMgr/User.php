<?php

namespace App\Entity\UserMgr;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass=App\Repository\UserMgr\UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="roles", type="string")
 * @ORM\DiscriminatorMap({
 *      "student" = "App\Entity\UserMgr\Student",
 *      "employer" = "App\Entity\UserMgr\Employer",
 *      "artean" = "App\Entity\UserMgr\Artean",
 *      "user" = "App\Entity\UserMgr\User",
 * })
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @Groups("user")
     * @ORM\Column(type="string", length=500)
     */
    private $password;

    /**
     * @Groups("user")
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     *
     */
    protected $rol = ['ROLE_USER'];

    public function __construct($username)
    {
        $this->isActive = true;
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRoles()
    {
        return $this->rol;
    }

    public function eraseCredentials()
    {
    }
}
