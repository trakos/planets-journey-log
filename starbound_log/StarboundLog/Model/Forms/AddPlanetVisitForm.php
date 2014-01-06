<?php

namespace StarboundLog\Model\Forms;

use Zend\Form\Annotation;

/**
 * Class AddPlanetVisitForm
 *
 * @package StarboundLog\Model\Forms
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Annotation\Attributes({"class":"mws-form-inline mws-form "})
 */
class AddPlanetVisitForm
{
    /* planet address definition */

    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\SectorSelect")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Options({"label":"Sector"})
     */
    public $planetSector;
    /**
     * @Annotation\Type("Zend\Form\Element\Number")
     * @Annotation\Attributes({"class":"large", "min":-2147483647,"step":1,"max":2147483646})
     * @Annotation\Options({"label":"System coordinate X"})
     */
    public $planetX;
    /**
     * @Annotation\Type("Zend\Form\Element\Number")
     * @Annotation\Attributes({"class":"large", "min":-2147483647,"step":1,"max":2147483646})
     * @Annotation\Options({"label":"System coordinate Y"})
     */
    public $planetY;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\PlanetSelect")
     * @Annotation\Options({"label":"Planet number", "description":"Planet number (it's displayed just after planet name in navigation view)"})
     */
    public $planetNumber;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\MoonSelect")
     * @Annotation\Options({"label":"Moon number", "description":"If it is a moon, select it's letter (it's displayed just after planet name and number); otherwise, leave ""main planet"" option."})
     */
    public $planetMoon;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\VersionSelect")
     * @Annotation\Options({"label":"Starbound version", "description":"Use ""newer"" if there was a new version that has not been included yet."})
     */
    public $versionId;

    /* planet description */

    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\BiomeSelect")
     * @Annotation\Options({"label":"Planet biome"})
     */
    public $biomeId;



    /**
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Options({"label":"Planet name", "description":"Planet name, without Roman numeral and moon letter"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"3","max":"255"}})
     */
    public $planetName;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\RatingSelect")
     * @Annotation\Options({"label":"Rating", "description":"How useful are resources found on this planet?"})
     */
    public $planetRating;
    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\PlanetTierSelect")
     * @Annotation\Options({"label":"Planet tier"})
     */
    public $planetTier;
    /**
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Attributes({"class"="ibutton", "data-label-on"="public", "data-label-off"="private"})
     * @Annotation\Options({"label":"Shared", "description":"Do you want to share it with the world, or would you rather keep your comment private?"})
     */
    public $visitShared;
    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Options({"label":"Planet description", "description":"Share what's so cool about this planet!"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"0","max":"10000"}})
     */
    public $visitComment;

    /**
     * @Annotation\Type("StarboundLog\Model\Forms\Elements\CharacterSelect")
     * @Annotation\Required(false)
     * @Annotation\Options({"label":"Your character (optional)", "description":"You can select which of your characters visited this planet."})
     */
    public $character;
    /**
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Required(false)
     * @Annotation\Attributes({"class":"large"})
     * @Annotation\Options({"label":"Description for character", "description":"Applies only if you have chosen character above; it will be kept private regardless of shared option."})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":"0","max":"10000"}})
     */
    public $characterComment;

    /**
     * @Annotation\Type("\Trks\Form\Element\ButtonRow")
     * @Annotation\Attributes({"buttons":{"Submit":1}})
     */
    public $submit;
} 