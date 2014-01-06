<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_starbound_versiongroups
 * 
 * 
 * name="starbound_versiongroups"
 */
class Row_starbound_versiongroups extends \Trks\Model\TrksAbstractRow
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
        \StarboundLog\Model\Database\Tables\Table_starbound_versiongroups::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_starbound_versiongroups::get()->getRow($primaryId);
    }


}
