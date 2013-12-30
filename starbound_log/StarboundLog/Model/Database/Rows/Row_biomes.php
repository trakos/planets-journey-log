<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_biomes
 * 
 * 
 * name="biomes"
 */
class Row_biomes
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
}
