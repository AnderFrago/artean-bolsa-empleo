<?php
/**
 * @title Employeers
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see A type of user that publish job offers
 */

namespace AppBundle\Entity\UserMgr;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employeers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserMgr\EmployeersRepository")
 */
class Employeers extends User {

  public function __construct()
  {
    parent::__construct();
    $this->offers = new ArrayCollection();
  }
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="v_CIF", type="string", length=45)
   */
  private $vCIF;

  /**
   * @ORM\Column(name="v_Name", type="string", length=255)
   */
  private $vName;

  /**
   * @ORM\Column(name="v_Logo", type="string", length=255)
   */
  private $vLogo;

  /**
   * @ORM\Column(name="v_Description", type="string", length=255)
   */
  private $vDescription;

  /**
   * @ORM\Column(name="v_Contact_Name", type="string", length=255)
   */
  private $vContactName;

  /**
   * @ORM\Column(name="v_Contact_Phone", type="string", length=255)
   */
  private $vContactPhone;

  /**
   * @ORM\Column(name="v_Contact_Mail", type="string", length=255)
   */
  private $vContactMail;

  /**
   * @ORM\Column(name="v_Location", type="string", length=255)
   */
  private $vLocation;

  /**
   * @ORM\Column(name="n_Number_Of_Workers", type="integer", nullable=true)
   */
  private $nNumberOfWorkers;

  /**
   * @ORM\Column(name="creation_user", type="string", length=45)
   */
  private $creationUser;

  /**
   * @ORM\Column(name="modification_user", type="string", length=45)
   */
  private $modificationUser;

  /**
   * @ORM\Column(name="creation_date", type="date")
   */
  private $creationDate;

  /**
   * @ORM\Column(name="modification_date", type="datetime")
   */
  private $modificationDate;


  /**
   * @see Autogenerated Getters & Setters
   */

  public function getId() {
    return $this->id;
  }

  public function setVCIF($vCIF) {
    $this->vCIF = $vCIF;
  }
  public function getVCIF() {
    return $this->vCIF;
  }

  public function setVName($vName) {
    $this->vName = $vName;
  }
  public function getVName() {
    return $this->vName;
  }

  public function setVLogo($vLogo) {
    $this->vLogo = $vLogo;
  }
  public function getVLogo() {
    return $this->vLogo;
  }

  public function setVDescription($vDescription) {
    $this->vDescription = $vDescription;
  }
  public function getVDescription() {
    return $this->vDescription;
  }

  public function setVContactName($vContactName) {
    $this->vContactName = $vContactName;
  }
  public function getVContactName() {
    return $this->vContactName;
  }

  public function setVContactPhone($vContactPhone) {
    $this->vContactPhone = $vContactPhone;
  }
  public function getVContactPhone() {
    return $this->vContactPhone;
  }

  public function setVContactMail($vContactMail) {
    $this->vContactMail = $vContactMail;
  }
  public function getVContactMail() {
    return $this->vContactMail;
  }

  public function setVLocation($vLocation) {
    $this->vLocation = $vLocation;
  }
  public function getVLocation() {
    return $this->vLocation;
  }

  public function setNNumberOfWorkers($nNumberOfWorkers) {
    $this->nNumberOfWorkers = $nNumberOfWorkers;
  }
  public function getNNumberOfWorkers() {
    return $this->nNumberOfWorkers;
  }

  public function setCreationUser($creationUser) {
    $this->creationUser = $creationUser;
  }
  public function getCreationUser() {
    return $this->creationUser;
  }

  public function setModificationUser($modificationUser) {
    $this->modificationUser = $modificationUser;
  }
  public function getModificationUser() {
    return $this->modificationUser;
  }

  public function setCreationDate($creationDate) {
    $this->creationDate = $creationDate;
  }
  public function getCreationDate() {
    return $this->creationDate;
  }

  public function setModificationDate($modificationDate) {
    $this->modificationDate = $modificationDate;
  }
  public function getModificationDate() {
    return $this->modificationDate;
  }

  /**
   * @see Method to establish the Role to this type of user
   */
  public function getRoles() {
    return ['ROLE_USER_EMPLOYEERS'];
  }

  /**
   * @ORM\OneToMany(targetEntity="AppBundle\Entity\OfferMgr\Offers", mappedBy="employeer")
   */
  private $offers;

}

