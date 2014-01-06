<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_characters_queue
 * 
 * 
 * name="characters_queue"
 */
class Row_characters_queue extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $chaque_id;

    /**
     * @var boolean
     */
    public $chaque_done;

    public $chaque_character_id;

    public $chaque_planet_id;


    public function exchangeArray($data)
    {
        $this->chaque_id = (isset($data['chaque_id'])) ? $data['chaque_id'] : null;
        $this->chaque_done = (isset($data['chaque_done'])) ? $data['chaque_done'] : null;
        $this->chaque_character_id = (isset($data['chaque_character_id'])) ? $data['chaque_character_id'] : null;
        $this->chaque_planet_id = (isset($data['chaque_planet_id'])) ? $data['chaque_planet_id'] : null;
    }

    public function toArray()
    {
        return array(
            'chaque_id' => $this->chaque_id,
            'chaque_done' => $this->chaque_done,
            'chaque_character_id' => $this->chaque_character_id,
            'chaque_planet_id' => $this->chaque_planet_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_characters_queue::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_characters_queue::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters|null
     */
    public function getChaqueCharacter()
    {
        if (!$this->chaque_character_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users_characters::get()->getRow($this->chaque_character_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users_characters $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setChaqueCharacter($entity)
    {
        if (!$entity->character_id) throw new \Exception("Row has to be initialized!");
        $this->chaque_character_id = $entity->character_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets|null
     */
    public function getChaquePlanet()
    {
        if (!$this->chaque_planet_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_planets::get()->getRow($this->chaque_planet_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_planets $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setChaquePlanet($entity)
    {
        if (!$entity->planet_id) throw new \Exception("Row has to be initialized!");
        $this->chaque_planet_id = $entity->planet_id;
    }

}
