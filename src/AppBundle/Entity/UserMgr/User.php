<?php
/**
 * @title User
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see The generic actor of the application which the access information
 */

namespace AppBundle\Entity\UserMgr;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="roles", type="string")
 * @ORM\DiscriminatorMap({
 *     "formerstudent" = "AppBundle\Entity\UserMgr\FormerStudents",
 *     "employeer" = "AppBundle\Entity\UserMgr\Employeers",
 *     "user" = "AppBundle\Entity\UserMgr\User"
 *
 * })
 * @UniqueEntity(fields={"username"}, message="El nombre de usuario ya está siendo usado.")
 * @UniqueEntity(fields={"email"}, message="El correo electrónico de usuario ya está siendo usado.")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserMgr\UsersRepository")
 */
class User implements UserInterface, \Serializable {
  public function __construct() {
    $this->isActive = 1;
  }
  /**
   * @see Necessary for the UserRegistrationForm,
   * the role is selected by radio buttons
   */
  private $roles=[];
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="string", length=25, unique=true)
   */
  private $username;
  /**
   * @ORM\Column(type="string", length=64)
   */
  private $password;
  /**
   * @ORM\Column(type="string", length=254, unique=true)
   */
  private $email;
  /**
   * @ORM\Column(name="is_active", type="boolean")
   */
  private $isActive = 1;

  /**
   * @see Autogenerated Getters & Setters
   */
  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }
  public function setEmail($email): void {
    $this->email = $email;
  }

  public function getUsername() {
    return $this->username;
  }
  public function setUsername($username) {
    $this->username = $username;
  }

  public function getIsActive() {
    return $this->isActive;
  }
  public function setIsActive($is_active) {
    $this->isActive = $is_active;
  }

  public function getSalt() {
    return NULL;
  }

  public function getPassword() {
    return $this->password;
  }
  public function setPassword($password) {
    $this->password = $password;
  }
  public function getPlainPassword() {
    return $this->password;
  }
  public function setPlainPassword($password) {
    $this->password = $password;
  }

  public function setRoles($role)
  {
   $this->roles[] = $role;
  }

  public function getRoles()
  {
    return  $this->roles;
  }

  public function eraseCredentials() {
  }


  /**
   * @see Methods used by the login form
   */
  public function serialize() {
    return serialize([
      $this->id,
      $this->username,
      $this->email,
      $this->password,
      $this->roles
    ]);
  }

  public function unserialize($serialized) {
    list (
      $this->id,
      $this->username,
      $this->email,
      $this->password,
      $this->roles
       ) = unserialize($serialized, ['allowed_classes' => FALSE]);
  }
}