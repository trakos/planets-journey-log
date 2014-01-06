<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_starbound_versions
 * 
 * 
 * name="starbound_versions"
 */
class Row_starbound_versions extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $version_id;

    /**
     * @var \DateTime
     */
    public $version_released;

    /**
     * @var string
     */
    public $version_label;


    public function exchangeArray($data)
    {
        $this->version_id = (isset($data['version_id'])) ? $data['version_id'] : null;
        $this->version_released = (isset($data['version_released'])) ? $data['version_released'] : null;
        $this->version_label = (isset($data['version_label'])) ? $data['version_label'] : null;
    }

    public function toArray()
    {
        return array(
            'version_id' => $this->version_id,
            'version_released' => $this->version_released,
            'version_label' => $this->version_label,
        );
    }
}
