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
     * @var boolean
     */
    public $planet_number;

    /**
     * @var boolean
     */
    public $planet_moon;

    public $planet_system_id;


    public function exchangeArray($data)
    {
        $this->planet_id = (isset($data['planet_id'])) ? $data['planet_id'] : null;
        $this->planet_number = (isset($data['planet_number'])) ? $data['planet_number'] : null;
        $this->planet_moon = (isset($data['planet_moon'])) ? $data['planet_moon'] : null;
        $this->planet_system_id = (isset($data['planet_system_id'])) ? $data['planet_system_id'] : null;
    }

    public function toArray()
    {
        return array(
            'planet_id' => $this->planet_id,
            'planet_number' => $this->planet_number,
            'planet_moon' => $this->planet_moon,
            'planet_system_id' => $this->planet_system_id,
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


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_systems|null
     */
    public function getPlanetSystem()
    {
        if (!$this->planet_system_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_systems::get()->getRow($this->planet_system_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_systems $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setPlanetSystem($entity)
    {
        if (!$entity->system_id) throw new \Exception("Row has to be initialized!");
        $this->planet_system_id = $entity->system_id;
    }

}
