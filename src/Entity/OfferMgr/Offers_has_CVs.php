<?php
/**
 * @title Offers has CVs
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see This entity represents that Offers can have multiple CVs
 * and that multiple CVs can be related to one offer
 */

namespace App\Entity\OfferMgr;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="offers_has_cvs")
 * @ORM\Entity(repositoryClass="App\Repository\OfferMgr\OffersHasCVsRepository")
 */
class Offers_has_CVs {

  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  public function getId() {
    return $this->id;
  }

  public function setId($id): void {
    $this->id = $id;
  }

  /**
   * @ORM\Column(name="status", type="text")
   */
  private $vStatus;

  public function getVStatus(): string {
    return $this->vStatus;
  }
  public function setVStatus(string $vStatus): void {
    $this->vStatus = $vStatus;
  }

  public function getOffer() {
    return $this->offer;
  }
  public function setOffer($offer): void {
    $this->offer = $offer;
  }

  public function getCv() {
    return $this->cv;
  }
  public function setCv($cv): void {
    $this->cv = $cv;
  }

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\OfferMgr\Offers", inversedBy="offers_has_cvs",cascade={"persist"})
   * @ORM\JoinColumn(name="id_offer", referencedColumnName="id")
   */
  private $offer;

  /**
   * @ORM\ManyToOne(targetEntity="App\Entity\CvMgr\CV", inversedBy="offers_has_cvs",cascade={"persist"})
   * @ORM\JoinColumn(name="id_cv", referencedColumnName="id")
   */
  private $cv;

}

