<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planets_visits
 * 
 * 
 * name="planets_visits"
 */
class Row_planets_visits extends \Trks\Model\TrksAbstractRow
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
        );
    }
}
