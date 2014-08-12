<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_dictionary_undegroundMiniBiomes
 * 
 * 
 * name="dictionary_undegroundMiniBiomes"
 */
class Row_dictionary_undegroundMiniBiomes extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $underbiome_id;

    /**
     * @var string
     */
    public $underbiome_name;


    public function exchangeArray($data)
    {
        $this->underbiome_id = (isset($data['underbiome_id'])) ? $data['underbiome_id'] : null;
        $this->underbiome_name = (isset($data['underbiome_name'])) ? $data['underbiome_name'] : null;
    }

    public function toArray()
    {
        return array(
            'underbiome_id' => $this->underbiome_id,
            'underbiome_name' => $this->underbiome_name,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_dictionary_undegroundMiniBiomes::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_dictionary_undegroundMiniBiomes::get()->getRow($primaryId);
    }


}
