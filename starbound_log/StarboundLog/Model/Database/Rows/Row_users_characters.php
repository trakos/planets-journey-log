<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users_characters
 * 
 * 
 * name="users_characters"
 */
class Row_users_characters extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $character_id;

    /**
     * @var string
     */
    public $character_name;

    public $character_user_id;


    public function exchangeArray($data)
    {
        $this->character_id = (isset($data['character_id'])) ? $data['character_id'] : null;
        $this->character_name = (isset($data['character_name'])) ? $data['character_name'] : null;
        $this->character_user_id = (isset($data['character_user_id'])) ? $data['character_user_id'] : null;
    }

    public function toArray()
    {
        return array(
            'character_id' => $this->character_id,
            'character_name' => $this->character_name,
            'character_user_id' => $this->character_user_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_users_characters::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_users_characters::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users|null
     */
    public function getCharacterUser()
    {
        if (!$this->character_user_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users::get()->getRow($this->character_user_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setCharacterUser($entity)
    {
        if (!$entity->user_id) throw new \Exception("Row has to be initialized!");
        $this->character_user_id = $entity->user_id;
    }

}
