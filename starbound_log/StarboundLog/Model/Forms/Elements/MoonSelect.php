<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class MoonSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        return array(
            0  => 'main planet',
            1  => 'a',
            2  => 'b',
            3  => 'c',
            4  => 'd',
            5  => 'e',
            6  => 'f',
            7  => 'g',
            8  => 'h',
            9  => 'i',
            10 => 'j',
            11 => 'k',
            12 => 'l',
        );
    }
} 