<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharactersQueue
 *
 * @ORM\Table(name="characters_queue")
 * @ORM\Entity
 */
class CharactersQueue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="chaque_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $chaqueId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chaque_done", type="boolean", nullable=false)
     */
    private $chaqueDone;

    /**
     * @var \StarboundLog\Model\Entities\UsersCharacters
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\UsersCharacters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chaque_character_id", referencedColumnName="character_id")
     * })
     */
    private $chaqueCharacter;

    /**
     * @var \StarboundLog\Model\Entities\Planets
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Planets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chaque_planet_id", referencedColumnName="planet_id")
     * })
     */
    private $chaquePlanet;



    /**
     * Get chaqueId
     *
     * @return integer 
     */
    public function getChaqueId()
    {
        return $this->chaqueId;
    }

    /**
     * Set chaqueDone
     *
     * @param boolean $chaqueDone
     * @return CharactersQueue
     */
    public function setChaqueDone($chaqueDone)
    {
        $this->chaqueDone = $chaqueDone;
    
        return $this;
    }

    /**
     * Get chaqueDone
     *
     * @return boolean 
     */
    public function getChaqueDone()
    {
        return $this->chaqueDone;
    }

    /**
     * Set chaqueCharacter
     *
     * @param \StarboundLog\Model\Entities\UsersCharacters $chaqueCharacter
     * @return CharactersQueue
     */
    public function setChaqueCharacter(\StarboundLog\Model\Entities\UsersCharacters $chaqueCharacter = null)
    {
        $this->chaqueCharacter = $chaqueCharacter;
    
        return $this;
    }

    /**
     * Get chaqueCharacter
     *
     * @return \StarboundLog\Model\Entities\UsersCharacters 
     */
    public function getChaqueCharacter()
    {
        return $this->chaqueCharacter;
    }

    /**
     * Set chaquePlanet
     *
     * @param \StarboundLog\Model\Entities\Planets $chaquePlanet
     * @return CharactersQueue
     */
    public function setChaquePlanet(\StarboundLog\Model\Entities\Planets $chaquePlanet = null)
    {
        $this->chaquePlanet = $chaquePlanet;
    
        return $this;
    }

    /**
     * Get chaquePlanet
     *
     * @return \StarboundLog\Model\Entities\Planets 
     */
    public function getChaquePlanet()
    {
        return $this->chaquePlanet;
    }
}