<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users_characters
 * 
 * 
 * name="users_characters"
 */
class Row_users_characters
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
}
