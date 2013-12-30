<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_characters_planets
 * 
 * 
 * name="characters_planets"
 */
class Row_characters_planets
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


    public function exchangeArray($data)
    {
        $this->chapla_id = (isset($data['chapla_id'])) ? $data['chapla_id'] : null;
        $this->chapla_time = (isset($data['chapla_time'])) ? $data['chapla_time'] : null;
        $this->chapla_notes = (isset($data['chapla_notes'])) ? $data['chapla_notes'] : null;
    }
}
