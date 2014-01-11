<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Select;
use ZendService\ReCaptcha\Exception;

class PlanetTierFilter extends Select
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->fetchValueOptions();
        parent::__construct($name, $options);
    }

    protected function fetchValueOptions()
    {
        $data = [];
        $data[0] = "all";
        for ($i = 1; $i<=10; $i++) {
            $data[$i] = $i;//'tier' . $i;
        }
        return $data;
    }
} 