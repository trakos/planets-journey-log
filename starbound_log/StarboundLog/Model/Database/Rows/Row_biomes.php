<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_biomes
 * 
 * 
 * name="biomes"
 */
class Row_biomes extends \Trks\Model\TrksAbstractRow
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
}
