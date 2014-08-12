<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_dictionary_biomes
 * 
 * 
 * name="dictionary_biomes"
 */
class Row_dictionary_biomes extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $biome_id;

    /**
     * @var string
     */
    public $biome_name;


    public function exchangeArray($data)
    {
        $this->biome_id = (isset($data['biome_id'])) ? $data['biome_id'] : null;
        $this->biome_name = (isset($data['biome_name'])) ? $data['biome_name'] : null;
    }

    public function toArray()
    {
        return array(
            'biome_id' => $this->biome_id,
            'biome_name' => $this->biome_name,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_dictionary_biomes::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_dictionary_biomes::get()->getRow($primaryId);
    }


}
