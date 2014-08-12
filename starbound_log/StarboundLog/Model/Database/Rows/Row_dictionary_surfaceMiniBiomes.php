<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_dictionary_surfaceMiniBiomes
 * 
 * 
 * name="dictionary_surfaceMiniBiomes"
 */
class Row_dictionary_surfaceMiniBiomes extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $surbiome_id;

    /**
     * @var string
     */
    public $surbiome_name;


    public function exchangeArray($data)
    {
        $this->surbiome_id = (isset($data['surbiome_id'])) ? $data['surbiome_id'] : null;
        $this->surbiome_name = (isset($data['surbiome_name'])) ? $data['surbiome_name'] : null;
    }

    public function toArray()
    {
        return array(
            'surbiome_id' => $this->surbiome_id,
            'surbiome_name' => $this->surbiome_name,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_dictionary_surfaceMiniBiomes::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_dictionary_surfaceMiniBiomes::get()->getRow($primaryId);
    }


}
