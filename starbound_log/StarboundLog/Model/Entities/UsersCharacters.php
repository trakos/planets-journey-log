<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersCharacters
 *
 * @ORM\Table(name="users_characters")
 * @ORM\Entity
 */
class UsersCharacters
{
    /**
     * @var integer
     *
     * @ORM\Column(name="character_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $characterId;

    /**
     * @var string
     *
     * @ORM\Column(name="character_name", type="string", length=64, nullable=false)
     */
    private $characterName;

    /**
     * @var \StarboundLog\Model\Entities\Users
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="character_user_id", referencedColumnName="user_id")
     * })
     */
    private $characterUser;



    /**
     * Get characterId
     *
     * @return integer 
     */
    public function getCharacterId()
    {
        return $this->characterId;
    }

    /**
     * Set characterName
     *
     * @param string $characterName
     * @return UsersCharacters
     */
    public function setCharacterName($characterName)
    {
        $this->characterName = $characterName;
    
        return $this;
    }

    /**
     * Get characterName
     *
     * @return string 
     */
    public function getCharacterName()
    {
        return $this->characterName;
    }

    /**
     * Set characterUser
     *
     * @param \StarboundLog\Model\Entities\Users $characterUser
     * @return UsersCharacters
     */
    public function setCharacterUser(\StarboundLog\Model\Entities\Users $characterUser = null)
    {
        $this->characterUser = $characterUser;
    
        return $this;
    }

    /**
     * Get characterUser
     *
     * @return \StarboundLog\Model\Entities\Users 
     */
    public function getCharacterUser()
    {
        return $this->characterUser;
    }
}