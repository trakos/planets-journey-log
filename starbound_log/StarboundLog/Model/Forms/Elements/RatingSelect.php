<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;

class RatingSelect extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $ratings = [];
        for ($i = 1; $i <= 10; $i++) {
            $ratings[$i] = $i;
        }
        return $ratings;
    }
} 