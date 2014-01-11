<?php

namespace StarboundLog\Model\Forms\Elements;


use Trks\Singletons\TrksDbAdapter;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Select;

class SectorRadio extends Radio
{
    public function __construct($name = null, $options = array())
    {
        $options['value_options'] = $this->ibuttonize($this->fetchValueOptions());
        parent::__construct($name, $options);
    }

    protected function ibuttonize($options)
    {
        $converted = [];
        foreach ($options as $key => $label) {
            $converted[] = array(
                'label'      => '',
                'value'      => $key,
                'attributes' => array(
                    'data-label-on'  => $label,
                    'data-label-off' => $label,
                    'class'          => 'ibutton'
                ),
            );
        }
        return $converted;
    }

    protected function fetchValueOptions()
    {
        return array(
            '1' => 'Α',// (alpha)',
            '2' => 'Β',// (beta)',
            '3' => 'Γ',// (gamma)',
            '4' => 'Δ',// (delta)',
            '5' => 'Χ',// (chi / sector X)',
        );
    }
} 