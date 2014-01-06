<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class VersionSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $q = 'SELECT version_id, version_label FROM starbound_versions ORDER BY version_released DESC';
        $a = [];
        $biomes = TrksDbAdapter::get()->fetchAll($q, $a);
        $versions = array_column($biomes, 'version_label', 'version_id');
        $versions['0'] = 'newer';
        return $versions;
    }
} 