<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;

class PlanetSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        return array(
            1  => 'I',
            2  => 'II',
            3  => 'III',
            4  => 'IV',
            5  => 'V',
            6  => 'VI',
            7  => 'VII',
            8  => 'VIII',
            9  => 'XI',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        );
    }
} 