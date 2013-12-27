<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planets
 *
 * @ORM\Table(name="planets")
 * @ORM\Entity
 */
class Planets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="planet_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $planetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="planet_x", type="integer", nullable=false)
     */
    private $planetX;

    /**
     * @var integer
     *
     * @ORM\Column(name="planet_y", type="integer", nullable=false)
     */
    private $planetY;



    /**
     * Get planetId
     *
     * @return integer 
     */
    public function getPlanetId()
    {
        return $this->planetId;
    }

    /**
     * Set planetX
     *
     * @param integer $planetX
     * @return Planets
     */
    public function setPlanetX($planetX)
    {
        $this->planetX = $planetX;
    
        return $this;
    }

    /**
     * Get planetX
     *
     * @return integer 
     */
    public function getPlanetX()
    {
        return $this->planetX;
    }

    /**
     * Set planetY
     *
     * @param integer $planetY
     * @return Planets
     */
    public function setPlanetY($planetY)
    {
        $this->planetY = $planetY;
    
        return $this;
    }

    /**
     * Get planetY
     *
     * @return integer 
     */
    public function getPlanetY()
    {
        return $this->planetY;
    }
}