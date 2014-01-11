<?php

namespace StarboundLog\Model\Forms;

use Zend\Form\Annotation;

/**
 * Class PlanetsFilterForm
 *
 * @package StarboundLog\Model\Forms
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Attributes({"class":"mws-form-inline mws-form "})
 */
class PlanetsFilterForm
{
    /* planet address definition */

    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\VersionGroupFilter")
     * @Annotation\Options({"label":"Starbound version", "description":"Use ""newer"" if there was a new version that has not been included yet."})
     */
    public $versionGroupId = 0;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\BiomeFilter")
     * @Annotation\Options({"label":"Planet biome"})
     */
    public $biomeId = 0;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\PlanetTierFilter")
     * @Annotation\Options({"label":"Planet tier", "filter_all": 1})
     */
    public $planetTier = 0;
} 