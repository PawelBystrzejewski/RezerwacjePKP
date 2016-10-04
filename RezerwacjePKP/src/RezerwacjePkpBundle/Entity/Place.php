<?php

namespace RezerwacjePkpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Place
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="RezerwacjePkpBundle\Entity\PlaceRepository")
 */
class Place
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="row", type="integer")
     */
    private $row;

    /**
     * @var integer
     *
     * @ORM\Column(name="seat", type="integer")
     */
    private $seat;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set row
     *
     * @param integer $row
     * @return Place
     */
    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * Get row
     *
     * @return integer 
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Set seat
     *
     * @param integer $seat
     * @return Place
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * Get seat
     *
     * @return integer 
     */
    public function getSeat()
    {
        return $this->seat;
    }
}
