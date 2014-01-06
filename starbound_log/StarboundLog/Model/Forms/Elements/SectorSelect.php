<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class SectorSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        return array(
            '1' => 'Α (alpha)',
            '2' => 'Β (beta)',
            '3' => 'Γ (gamma)',
            '4' => 'Δ (delta)',
            '5' => 'Χ (chi / sector X)',
        );
    }
} 