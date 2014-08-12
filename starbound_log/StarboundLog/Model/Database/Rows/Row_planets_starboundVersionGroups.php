<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planets_starboundVersionGroups
 * 
 * 
 * name="planets_starboundVersionGroups"
 */
class Row_planets_starboundVersionGroups extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $vergroup_id;

    /**
     * @var string
     */
    public $vergroup_label;


    public function exchangeArray($data)
    {
        $this->vergroup_id = (isset($data['vergroup_id'])) ? $data['vergroup_id'] : null;
        $this->vergroup_label = (isset($data['vergroup_label'])) ? $data['vergroup_label'] : null;
    }

    public function toArray()
    {
        return array(
            'vergroup_id' => $this->vergroup_id,
            'vergroup_label' => $this->vergroup_label,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_planets_starboundVersionGroups::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_planets_starboundVersionGroups::get()->getRow($primaryId);
    }


}
