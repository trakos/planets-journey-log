<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class VersionGroupFilter extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $q = 'SELECT GROUP_CONCAT(version_id) AS versions_id, vergroup_label FROM starbound_versiongroups JOIN starbound_versions ON version_vergroup_id = vergroup_id GROUP BY vergroup_id ORDER BY vergroup_id DESC';
        $a = [];
        $biomes = TrksDbAdapter::get()->fetchAll($q, $a);
        $versions = array_column($biomes, 'vergroup_label', 'versions_id');
        return $versions;
    }
} 