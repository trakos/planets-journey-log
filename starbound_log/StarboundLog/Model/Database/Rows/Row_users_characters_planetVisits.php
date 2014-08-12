<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users_characters_planetVisits
 * 
 * 
 * name="users_characters_planetVisits"
 */
class Row_users_characters_planetVisits extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $chapla_id;

    /**
     * @var \DateTime
     */
    public $chapla_time;

    /**
     * @var string
     */
    public $chapla_notes;

    public $chapla_character_id;

    public $chapla_planet_id;


    public function exchangeArray($data)
    {
        $this->chapla_id = (isset($data['chapla_id'])) ? $data['chapla_id'] : null;
        $this->chapla_time = (isset($data['chapla_time'])) ? $data['chapla_time'] : null;
        $this->chapla_notes = (isset($data['chapla_notes'])) ? $data['chapla_notes'] : null;
        $this->chapla_character_id = (isset($data['chapla_character_id'])) ? $data['chapla_character_id'] : null;
        $this->chapla_planet_id = (isset($data['chapla_planet_id'])) ? $data['chapla_planet_id'] : null;
    }

    public function toArray()
    {
        return array(
            'chapla_id' => $this->chapla_id,
            'chapla_time' => $this->chapla_time,
            'chapla_notes' => $this->chapla_notes,
            'chapla_character_id' => $this->chapla_character_id,
            'chapla_planet_id' => $this->chapla_planet_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_users_characters_planetVisits::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_users_characters_planetVisits::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters|null
     */
    public function getChaplaCharacter()
    {
        if (!$this->chapla_character_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users_characters::get()->getRow($this->chapla_character_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users_characters $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setChaplaCharacter($entity)
    {
        if (!$entity->character_id) throw new \Exception("Row has to be initialized!");
        $this->chapla_character_id = $entity->character_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets|null
     */
    public function getChaplaPlanet()
    {
        if (!$this->chapla_planet_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_planets::get()->getRow($this->chapla_planet_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_planets $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setChaplaPlanet($entity)
    {
        if (!$entity->planet_id) throw new \Exception("Row has to be initialized!");
        $this->chapla_planet_id = $entity->planet_id;
    }

}
