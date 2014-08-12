<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_dictionary_dungeons
 * 
 * 
 * name="dictionary_dungeons"
 */
class Row_dictionary_dungeons extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $dungeon_id;

    /**
     * @var string
     */
    public $dungeon_name;


    public function exchangeArray($data)
    {
        $this->dungeon_id = (isset($data['dungeon_id'])) ? $data['dungeon_id'] : null;
        $this->dungeon_name = (isset($data['dungeon_name'])) ? $data['dungeon_name'] : null;
    }

    public function toArray()
    {
        return array(
            'dungeon_id' => $this->dungeon_id,
            'dungeon_name' => $this->dungeon_name,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_dictionary_dungeons::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_dictionary_dungeons::get()->getRow($primaryId);
    }


}
