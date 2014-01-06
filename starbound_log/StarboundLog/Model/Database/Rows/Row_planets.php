<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planets
 * 
 * 
 * name="planets"
 */
class Row_planets extends \Trks\Model\TrksAbstractRow
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

    public function toArray()
    {
        return array(
            'planet_id' => $this->planet_id,
            'planet_x' => $this->planet_x,
            'planet_y' => $this->planet_y,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_planets::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_planets::get()->getRow($primaryId);
    }


}
