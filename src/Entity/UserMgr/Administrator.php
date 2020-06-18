<?php

/**
 * @title Administrator
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Type of user that manage the website
 */

namespace App\Entity\UserMgr;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="administrators")
 * @ORM\Entity(repositoryClass="App\Repository\UserMgr\UsersRepository")
 */
class Administrator extends User {

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @see Method to establish the Role to this type of user
     */
    public function getRoles() {
        return ['ROLE_ARTEAN'];
    }


    public function __toString(): string
    {
        return   $this->getEmail();
    }

}