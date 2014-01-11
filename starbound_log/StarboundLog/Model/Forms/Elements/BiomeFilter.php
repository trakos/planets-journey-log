<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class BiomeFilter extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $q = 'SELECT biome_id, biome_name FROM biomes ORDER BY biome_name';
        $a = [];
        $biomes = TrksDbAdapter::get()->fetchAll($q, $a);
        return [0 => 'all'] + array_column($biomes, 'biome_name', 'biome_id');
    }
} 