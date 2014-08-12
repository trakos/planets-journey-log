<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_users_visitsRating
 * 
 * 
 * name="users_visitsRating"
 */
class Row_users_visitsRating extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $rating_id;

    /**
     * @var boolean
     */
    public $rating_mark;

    public $rating_user_id;

    public $rating_visit_id;


    public function exchangeArray($data)
    {
        $this->rating_id = (isset($data['rating_id'])) ? $data['rating_id'] : null;
        $this->rating_mark = (isset($data['rating_mark'])) ? $data['rating_mark'] : null;
        $this->rating_user_id = (isset($data['rating_user_id'])) ? $data['rating_user_id'] : null;
        $this->rating_visit_id = (isset($data['rating_visit_id'])) ? $data['rating_visit_id'] : null;
    }

    public function toArray()
    {
        return array(
            'rating_id' => $this->rating_id,
            'rating_mark' => $this->rating_mark,
            'rating_user_id' => $this->rating_user_id,
            'rating_visit_id' => $this->rating_visit_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_users_visitsRating::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_visitsRating|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_users_visitsRating::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users|null
     */
    public function getRatingUser()
    {
        if (!$this->rating_user_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_users::get()->getRow($this->rating_user_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_users $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setRatingUser($entity)
    {
        if (!$entity->user_id) throw new \Exception("Row has to be initialized!");
        $this->rating_user_id = $entity->user_id;
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_visits|null
     */
    public function getRatingVisit()
    {
        if (!$this->rating_visit_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_visits::get()->getRow($this->rating_visit_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_visits $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setRatingVisit($entity)
    {
        if (!$entity->visit_id) throw new \Exception("Row has to be initialized!");
        $this->rating_visit_id = $entity->visit_id;
    }

}
