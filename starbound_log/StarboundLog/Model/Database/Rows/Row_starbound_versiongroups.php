<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_starbound_versiongroups
 * 
 * 
 * name="starbound_versiongroups"
 */
class Row_starbound_versiongroups
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
}
