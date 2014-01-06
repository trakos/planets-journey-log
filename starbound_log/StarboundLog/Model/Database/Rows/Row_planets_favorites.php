<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planets_favorites
 * 
 * 
 * name="planets_favorites"
 */
class Row_planets_favorites extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $plafav_id;

    public $plafav_user_id;

    public $plafav_planet_id;


    public function exchangeArray($data)
    {
        $this->plafav_id = (isset($data['plafav_id'])) ? $data['plafav_id'] : null;
        $this->plafav_user_id = (isset($data['plafav_user_id'])) ? $data['plafav_user_id'] : null;
        $this->plafav_planet_id = (isset($data['plafav_planet_id'])) ? $data['plafav_planet_id'] : null;
    }

    public function toArray()
    {
        return array(
            'plafav_id' => $this->plafav_id,
            'plafav_user_id' => $this->plafav_user_id,
            'plafav_planet_id' => $this->plafav_planet_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_planets_favorites::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_favorites|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_planets_favorites::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users|null
     */
    public function getPlafavUser()
    {
        if (!$this->plafav_user_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users::get()->getRow($this->plafav_user_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setPlafavUser($entity)
    {
        if (!$entity->user_id) throw new \Exception("Row has to be initialized!");
        $this->plafav_user_id = $entity->user_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets|null
     */
    public function getPlafavPlanet()
    {
        if (!$this->plafav_planet_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_planets::get()->getRow($this->plafav_planet_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_planets $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setPlafavPlanet($entity)
    {
        if (!$entity->planet_id) throw new \Exception("Row has to be initialized!");
        $this->plafav_planet_id = $entity->planet_id;
    }

}
