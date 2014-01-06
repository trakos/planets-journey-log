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


    public function exchangeArray($data)
    {
        $this->character_id = (isset($data['character_id'])) ? $data['character_id'] : null;
        $this->character_name = (isset($data['character_name'])) ? $data['character_name'] : null;
    }

    public function toArray()
    {
        return array(
            'character_id' => $this->character_id,
            'character_name' => $this->character_name,
        );
    }
}
