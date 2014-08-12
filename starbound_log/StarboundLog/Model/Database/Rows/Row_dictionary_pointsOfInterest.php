<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_dictionary_pointsOfInterest
 * 
 * 
 * name="dictionary_pointsOfInterest"
 */
class Row_dictionary_pointsOfInterest extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $poi_id;

    /**
     * @var string
     */
    public $poi_name;


    public function exchangeArray($data)
    {
        $this->poi_id = (isset($data['poi_id'])) ? $data['poi_id'] : null;
        $this->poi_name = (isset($data['poi_name'])) ? $data['poi_name'] : null;
    }

    public function toArray()
    {
        return array(
            'poi_id' => $this->poi_id,
            'poi_name' => $this->poi_name,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_dictionary_pointsOfInterest::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_dictionary_pointsOfInterest::get()->getRow($primaryId);
    }


}
