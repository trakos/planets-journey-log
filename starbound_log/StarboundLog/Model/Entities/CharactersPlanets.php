<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharactersPlanets
 *
 * @ORM\Table(name="characters_planets")
 * @ORM\Entity
 */
class CharactersPlanets
{
    /**
     * @var integer
     *
     * @ORM\Column(name="chapla_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $chaplaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="chapla_time", type="datetime", nullable=false)
     */
    private $chaplaTime;

    /**
     * @var string
     *
     * @ORM\Column(name="chapla_notes", type="text", nullable=false)
     */
    private $chaplaNotes;

    /**
     * @var \StarboundLog\Model\Entities\UsersCharacters
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\UsersCharacters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chapla_character_id", referencedColumnName="character_id")
     * })
     */
    private $chaplaCharacter;

    /**
     * @var \StarboundLog\Model\Entities\Planets
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Planets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chapla_planet_id", referencedColumnName="planet_id")
     * })
     */
    private $chaplaPlanet;



    /**
     * Get chaplaId
     *
     * @return integer 
     */
    public function getChaplaId()
    {
        return $this->chaplaId;
    }

    /**
     * Set chaplaTime
     *
     * @param \DateTime $chaplaTime
     * @return CharactersPlanets
     */
    public function setChaplaTime($chaplaTime)
    {
        $this->chaplaTime = $chaplaTime;
    
        return $this;
    }

    /**
     * Get chaplaTime
     *
     * @return \DateTime 
     */
    public function getChaplaTime()
    {
        return $this->chaplaTime;
    }

    /**
     * Set chaplaNotes
     *
     * @param string $chaplaNotes
     * @return CharactersPlanets
     */
    public function setChaplaNotes($chaplaNotes)
    {
        $this->chaplaNotes = $chaplaNotes;
    
        return $this;
    }

    /**
     * Get chaplaNotes
     *
     * @return string 
     */
    public function getChaplaNotes()
    {
        return $this->chaplaNotes;
    }

    /**
     * Set chaplaCharacter
     *
     * @param \StarboundLog\Model\Entities\UsersCharacters $chaplaCharacter
     * @return CharactersPlanets
     */
    public function setChaplaCharacter(\StarboundLog\Model\Entities\UsersCharacters $chaplaCharacter = null)
    {
        $this->chaplaCharacter = $chaplaCharacter;
    
        return $this;
    }

    /**
     * Get chaplaCharacter
     *
     * @return \StarboundLog\Model\Entities\UsersCharacters 
     */
    public function getChaplaCharacter()
    {
        return $this->chaplaCharacter;
    }

    /**
     * Set chaplaPlanet
     *
     * @param \StarboundLog\Model\Entities\Planets $chaplaPlanet
     * @return CharactersPlanets
     */
    public function setChaplaPlanet(\StarboundLog\Model\Entities\Planets $chaplaPlanet = null)
    {
        $this->chaplaPlanet = $chaplaPlanet;
    
        return $this;
    }

    /**
     * Get chaplaPlanet
     *
     * @return \StarboundLog\Model\Entities\Planets 
     */
    public function getChaplaPlanet()
    {
        return $this->chaplaPlanet;
    }
}