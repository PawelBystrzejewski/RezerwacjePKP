<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Passage
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ReservationBundle\Entity\PassageRepository")
 */
class Passage {

    /**
     * @ORM\OneToMany(targetEntity="Place", mappedBy="passage")
     */
    private $passages;

    public function __construct() {
        $this->passages = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255)
     */
    private $route;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="noOfPlaces", type="integer")
     */
    private $noOfPlaces;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return Passage
     */
    public function setRoute($route) {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute() {
        return $this->route;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Passage
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Add passages
     *
     * @param \ReservationBundle\Entity\Place $passages
     * @return Passage
     */
    public function addPassage(\ReservationBundle\Entity\Place $passages) {
        $this->passages[] = $passages;

        return $this;
    }

    /**
     * Remove passages
     *
     * @param \ReservationBundle\Entity\Place $passages
     */
    public function removePassage(\ReservationBundle\Entity\Place $passages) {
        $this->passages->removeElement($passages);
    }

    /**
     * Get passages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPassages() {
        return $this->passages;
    }

    /**
     * Set noOfPlaces
     *
     * @param integer $noOfPlaces
     * @return Passage
     */
    public function setNoOfPlaces($noOfPlaces) {
        $this->noOfPlaces = $noOfPlaces;

        return $this;
    }

    /**
     * Get noOfPlaces
     *
     * @return integer 
     */
    public function getNoOfPlaces() {
        return $this->noOfPlaces;
    }

}
