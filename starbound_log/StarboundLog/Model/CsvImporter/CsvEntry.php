<?php

namespace StarboundLog\Model\CsvImporter;



class CsvEntry
{
    const SECTOR_ALPHA = 1;
    const SECTOR_BETA = 2;
    const SECTOR_GAMMA = 3;
    const SECTOR_DELTA = 4;
    const SECTOR_X = 5;


    public $rating;
    /**
     * Timestamp - 12/10/2013 4:52:44 (m/d/y h:i:s)
     * @var \DateTime
     */
    public $timestamp;
    /**
     * Sector - Alpha / Beta / Gamma / Delta / X
     * @var string
     */
    public $sector;
    /**
     * X Coordinate - 62010507
     * @var int
     */
    public $xCoordinate;
    /**
     * Y coordinate - 89119690
     * @var int
     */
    public $yCoordinate;
    /**
     * Planet Name - Alpha Diadem 028 III C
     * @var string
     */
    public $planetName;
    /**
     * Planet number
     * @var int
     */
    public $planetNumber;
    /**
     * Planet moon
     * @var int
     */
    public $planetMoon;
    /**
     * Description
     * @var string
     */
    public $description;
    /**
     * Level - 1
     * @var int
     */
    public $tier;
    /**
     * Founder - Nuker1110
     * @var string
     */
    public $addedBy;
    /**
     * Biome
     * @var string
     */
    public $biome;
    /**
     * Game Version
     * @var int
     */
    public $gameVersion;
    /**
     * Main Structure - Tech, Instrument, Mini-Boss
     * @var string
     */
    public $mainStructure;
} 