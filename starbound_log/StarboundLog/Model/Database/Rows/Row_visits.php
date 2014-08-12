<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_visits
 * 
 * 
 * name="visits"
 */
class Row_visits extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $visit_id;

    /**
     * @var string
     */
    public $visit_name;

    /**
     * @var integer
     */
    public $visit_rating;

    /**
     * @var integer
     */
    public $visit_tier;

    /**
     * @var string
     */
    public $visit_comment;

    /**
     * @var boolean
     */
    public $visit_shared;

    /**
     * @var \DateTime
     */
    public $visit_created;

    /**
     * @var \DateTime
     */
    public $visit_updated;

    public $visit_user_id;

    public $visit_planet_id;

    public $visit_biome_id;


    public function exchangeArray($data)
    {
        $this->visit_id = (isset($data['visit_id'])) ? $data['visit_id'] : null;
        $this->visit_name = (isset($data['visit_name'])) ? $data['visit_name'] : null;
        $this->visit_rating = (isset($data['visit_rating'])) ? $data['visit_rating'] : null;
        $this->visit_tier = (isset($data['visit_tier'])) ? $data['visit_tier'] : null;
        $this->visit_comment = (isset($data['visit_comment'])) ? $data['visit_comment'] : null;
        $this->visit_shared = (isset($data['visit_shared'])) ? $data['visit_shared'] : null;
        $this->visit_created = (isset($data['visit_created'])) ? $data['visit_created'] : null;
        $this->visit_updated = (isset($data['visit_updated'])) ? $data['visit_updated'] : null;
        $this->visit_user_id = (isset($data['visit_user_id'])) ? $data['visit_user_id'] : null;
        $this->visit_planet_id = (isset($data['visit_planet_id'])) ? $data['visit_planet_id'] : null;
        $this->visit_biome_id = (isset($data['visit_biome_id'])) ? $data['visit_biome_id'] : null;
    }

    public function toArray()
    {
        return array(
            'visit_id' => $this->visit_id,
            'visit_name' => $this->visit_name,
            'visit_rating' => $this->visit_rating,
            'visit_tier' => $this->visit_tier,
            'visit_comment' => $this->visit_comment,
            'visit_shared' => $this->visit_shared,
            'visit_created' => $this->visit_created,
            'visit_updated' => $this->visit_updated,
            'visit_user_id' => $this->visit_user_id,
            'visit_planet_id' => $this->visit_planet_id,
            'visit_biome_id' => $this->visit_biome_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_visits::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_visits|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_visits::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users|null
     */
    public function getVisitUser()
    {
        if (!$this->visit_user_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users::get()->getRow($this->visit_user_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setVisitUser($entity)
    {
        if (!$entity->user_id) throw new \Exception("Row has to be initialized!");
        $this->visit_user_id = $entity->user_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets|null
     */
    public function getVisitPlanet()
    {
        if (!$this->visit_planet_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_planets::get()->getRow($this->visit_planet_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_planets $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setVisitPlanet($entity)
    {
        if (!$entity->planet_id) throw new \Exception("Row has to be initialized!");
        $this->visit_planet_id = $entity->planet_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|null
     */
    public function getVisitBiome()
    {
        if (!$this->visit_biome_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_dictionary_biomes::get()->getRow($this->visit_biome_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_biomes $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setVisitBiome($entity)
    {
        if (!$entity->biome_id) throw new \Exception("Row has to be initialized!");
        $this->visit_biome_id = $entity->biome_id;
    }

}
