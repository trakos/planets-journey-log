<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_characters_queue
 * 
 * 
 * name="characters_queue"
 */
class Row_characters_queue
{
    /**
     * @var integer
     */
    public $chaque_id;

    /**
     * @var boolean
     */
    public $chaque_done;


    public function exchangeArray($data)
    {
        $this->chaque_id = (isset($data['chaque_id'])) ? $data['chaque_id'] : null;
        $this->chaque_done = (isset($data['chaque_done'])) ? $data['chaque_done'] : null;
    }
}
