<?php

namespace StarboundLog\Library\Menu;


class Item
{

    function __construct($href, $icon, $label)
    {
        $this->href  = $href;
        $this->icon  = $icon;
        $this->label = $label;
    }


    public $href;
    public $icon;
    public $label;
} 