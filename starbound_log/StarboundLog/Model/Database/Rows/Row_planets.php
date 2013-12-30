<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planets
 * 
 * 
 * name="planets"
 */
class Row_planets
{
    /**
     * @var integer
     */
    public $planet_id;

    /**
     * @var integer
     */
    public $planet_x;

    /**
     * @var integer
     */
    public $planet_y;


    public function exchangeArray($data)
    {
        $this->planet_id = (isset($data['planet_id'])) ? $data['planet_id'] : null;
        $this->planet_x = (isset($data['planet_x'])) ? $data['planet_x'] : null;
        $this->planet_y = (isset($data['planet_y'])) ? $data['planet_y'] : null;
    }
}
