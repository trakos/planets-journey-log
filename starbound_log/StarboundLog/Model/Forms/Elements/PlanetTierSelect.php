<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class PlanetTierSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        return array(
            1 => 'tier 1',
            2 => 'tier 2',
            3 => 'tier 3',
            4 => 'tier 4',
            5 => 'tier 5',
            6 => 'tier 6',
            7 => 'tier 7',
            8 => 'tier 8',
            9 => 'tier 9',
            10 => 'tier 10',
        );
    }
} 