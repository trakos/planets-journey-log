<?php

namespace StarboundLog\Model\CsvImporter;


use ZendService\ReCaptcha\Exception;

class CsvImporter
{
    const INDEX_TIMESTAMP_S      = "Timestamp";
    const INDEX_TIMESTAMP_I      = 0;
    const INDEX_SECTOR_S         = "Sector";
    const INDEX_SECTOR_I         = 1;
    const INDEX_COORDINATE_X_S   = "X Coordinate";
    const INDEX_COORDINATE_X_I   = 2;
    const INDEX_COORDINATE_Y_S   = "Y Coordinate";
    const INDEX_COORDINATE_Y_I   = 3;
    const INDEX_PLANET_NAME_S    = "Planet Name";
    const INDEX_PLANET_NAME_I    = 4;
    const INDEX_DESCRIPTION_S    = "Description";
    const INDEX_DESCRIPTION_I    = 5;
    const INDEX_TIER_S           = "Level";
    const INDEX_TIER_I           = 6;
    const INDEX_USER_S           = "Founder";
    const INDEX_USER_I           = 7;
    const INDEX_BIOME_S          = "Biome";
    const INDEX_BIOME_I          = 8;
    const INDEX_VERSION_S        = "Game Version";
    const INDEX_VERSION_I        = 9;
    const INDEX_MAIN_STRUCTURE_S = "Main Structure";
    const INDEX_MAIN_STRUCTURE_I = 10;

    const DEBUG_SWITCHES = 0;

    const BIOME_ARCTIC             = 12;
    const BIOME_ARID               = 4;
    const BIOME_ASTEROID           = 16;
    const BIOME_DESERT             = 11;
    const BIOME_FOREST             = 1;
    const BIOME_FROZEN_OCEAN       = 12;
    const BIOME_GRASSLANDS         = 2;
    const BIOME_JUNGLE             = 5;
    const BIOME_MAGMA              = 9;
    const BIOME_MOON               = 15;
    const BIOME_SAVANNAH           = 3;
    const BIOME_SNOW               = 14;
    const BIOME_TENTACLE           = 8;
    const BIOME_TUNDRA             = 13;

    const VERSION_ANNOYED_KOALA    = 2;
    const VERSION_INDIGNANT_KOALA  = 4;
    const VERSION_OFFENDED_KOALA   = 5;
    const VERSION_ANGRY_KOALA      = 6;
    const VERSION_IRRITATED_KOALA  = 1;
    const VERSION_FRUSTRATED_KOALA = 3;

    const OPTIMAL_LENGTH = 500;

    static public $errorCount;

    /**
     * @param $filePath
     *
     * @return CsvEntry[]
     */
    static public function read($filePath)
    {
        self::$errorCount = 0;
        $data             = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {

            self::verifyIndexes($handle);
            self::ignoreLine($handle);

            while (($lineData = fgetcsv($handle, 1000, ",")) !== FALSE) {
                try {
                    $data[] = self::parseLine($lineData);
                } catch (Exception $e) {
                    self::$errorCount++;
                }
            }
            fclose($handle);
        }
        if (self::DEBUG_SWITCHES && T_DEBUG) {
            sort(self::$biomes);
            print_r(array_unique(self::$biomes));
            print_r(array_unique(self::$versions));
            print_r(self::$errorNames);
            echo PHP_EOL . self::$errorCount . "!" . PHP_EOL;
        }
        return $data;
    }

    static protected function verifyIndexes($handle)
    {
        $lineData = fgetcsv($handle, 1000, ",");
        if ($lineData[self::INDEX_TIMESTAMP_I] != self::INDEX_TIMESTAMP_S) throw new Exception("!");
        if ($lineData[self::INDEX_SECTOR_I] != self::INDEX_SECTOR_S) throw new Exception("!");
        if ($lineData[self::INDEX_COORDINATE_X_I] != self::INDEX_COORDINATE_X_S) throw new Exception("!");
        if ($lineData[self::INDEX_COORDINATE_Y_I] != self::INDEX_COORDINATE_Y_S) throw new Exception("!");
        if ($lineData[self::INDEX_PLANET_NAME_I] != self::INDEX_PLANET_NAME_S) throw new Exception("!");
        if ($lineData[self::INDEX_DESCRIPTION_I] != self::INDEX_DESCRIPTION_S) throw new Exception("!");
        if ($lineData[self::INDEX_TIER_I] != self::INDEX_TIER_S) throw new Exception("!");
        if ($lineData[self::INDEX_USER_I] != self::INDEX_USER_S) throw new Exception("!");
        if ($lineData[self::INDEX_BIOME_I] != self::INDEX_BIOME_S) throw new Exception("!");
        if ($lineData[self::INDEX_VERSION_I] != self::INDEX_VERSION_S) throw new Exception("!");
        if ($lineData[self::INDEX_MAIN_STRUCTURE_I] != self::INDEX_MAIN_STRUCTURE_S) throw new Exception("!");
    }

    static protected function ignoreLine($handle)
    {
        fgetcsv($handle, 1000, ",");
    }

    static protected function parseLine($lineData)
    {
        $entity                = new CsvEntry();
        $entity->addedBy       = $lineData[self::INDEX_USER_I];
        $entity->biome         = self::parseBiome($lineData[self::INDEX_BIOME_I]);
        $entity->description   = $lineData[self::INDEX_DESCRIPTION_I];
        $entity->rating        = 5 + min(5, round(strlen($lineData[self::INDEX_DESCRIPTION_I]) * 5 / self::OPTIMAL_LENGTH));
        $entity->gameVersion   = self::parseGameVersion($lineData[self::INDEX_VERSION_I]);
        $entity->mainStructure = $lineData[self::INDEX_MAIN_STRUCTURE_I];
        list ($entity->planetName, $entity->planetNumber, $entity->planetMoon) = self::parsePlanetName($lineData[self::INDEX_PLANET_NAME_I]);
        $entity->sector      = self::parseSector($lineData[self::INDEX_SECTOR_I]);
        $entity->tier        = self::verifyNumber($lineData[self::INDEX_TIER_I]);
        $entity->timestamp   = self::parseDate($lineData[self::INDEX_TIMESTAMP_I]);
        $entity->xCoordinate = self::verifyNumber($lineData[self::INDEX_COORDINATE_X_I]);
        $entity->yCoordinate = self::verifyNumber($lineData[self::INDEX_COORDINATE_Y_I]);
        return $entity;
    }

    static $biomes = [];

    static protected function parseBiome($biome)
    {
        switch (strtolower($biome)) {
            case 'arctic':
                return self::BIOME_ARCTIC;
            case 'aric':
            case 'arid':
                return self::BIOME_ARID;
            case 'asteroid belt':
                return self::BIOME_ASTEROID;
            case 'desert':
                return self::BIOME_DESERT;
            case 'forest':
                return self::BIOME_FOREST;
            case 'frozen ocean':
                return self::BIOME_FROZEN_OCEAN;
            case 'grasslands':
                return self::BIOME_GRASSLANDS;
            case 'jungle':
                return self::BIOME_JUNGLE;
            case 'lava':
            case 'magma':
            case 'volcanic':
                return self::BIOME_MAGMA;
            case 'moon':
                return self::BIOME_MOON;
            case 'savannah':
                return self::BIOME_SAVANNAH;
            case 'snow':
                return self::BIOME_SNOW;
            case 'tentacle':
                return self::BIOME_TENTACLE;
            case 'thundra':
            case 'tundra':
                return self::BIOME_TUNDRA;
            default:
                self::$biomes[] = $biome;
                throw new Exception($biome . "!");
        }
    }

    static $versions = [];

    private static function parseGameVersion($gameVersion)
    {
        $gameVersion = strtolower($gameVersion);
        $gameVersion = mb_convert_encoding($gameVersion, "ASCII");
        $gameVersion = str_replace(array("beta v", " - ", " -??", "-", "koala", "koalo"), "", $gameVersion);
        $gameVersion = trim($gameVersion);
        switch (strtolower($gameVersion)) {
            case 'annoyed':
                return self::VERSION_ANNOYED_KOALA;
            case 'indignant':
                return self::VERSION_INDIGNANT_KOALA;
            case 'offended':
            case 'ofended':
                return self::VERSION_OFFENDED_KOALA;
            case 'angry':
                return self::VERSION_ANGRY_KOALA;
            case 'irritated':
                return self::VERSION_IRRITATED_KOALA;
            case "frustrated":
                return self::VERSION_FRUSTRATED_KOALA;
            case "perturbed":
            default:
                self::$versions[] = $gameVersion;
                throw new Exception($gameVersion . "!");
        }
    }

    static $errorNames = [];

    private static function parsePlanetName($planetName)
    {
        $name   = '';
        $number = 0;
        $moon   = 0;

        $planetName = trim($planetName);

        $matches = [];
        if (!preg_match("/^(.*)\\s([IVX]+)\\s?([a-zA-Z])?$/", $planetName, $matches)) {
            if (!preg_match("/^(\\s*)([IVX]+)\\s?([a-zA-Z])?$/", $planetName, $matches)) {
                self::$errorNames[] = $planetName;
                throw new Exception($planetName . "!");
            }
        }
        $name   = $matches[1];
        $number = self::parseRomanNumeral($matches[2]);
        if (isset($matches[3])) {
            $moon = ord(strtolower($matches[3])) - ord('a') + 1;
        }

        return [$name, $number, $moon];
    }

    protected static function parseRomanNumeral($roman)
    {
        $romanValues = array(
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        );

        $arabic = 0;
        $prev   = null;
        for ($n = strlen($roman) - 1; $n >= 0; --$n) {
            $curr = $roman[$n];
            if (is_null($prev)) {
                $arabic += $romanValues[$roman[$n]];
            } else {
                $arabic += $romanValues[$prev] > $romanValues[$curr] ? -$romanValues[$curr] : +$romanValues[$curr];
            }
            $prev = $curr;
        }

        return $arabic;
    }

    private static function parseSector($sector)
    {
        switch (strtolower($sector)) {
            case 'alpha':
                return CsvEntry::SECTOR_ALPHA;
            case 'beta':
                return CsvEntry::SECTOR_BETA;
            case 'gamma':
                return CsvEntry::SECTOR_GAMMA;
            case 'delta':
                return CsvEntry::SECTOR_DELTA;
            case 'x':
                return CsvEntry::SECTOR_X;
            default:
                throw new Exception("!");
        }
    }

    private static function verifyNumber($tier)
    {
        if (!is_numeric($tier)) throw new Exception("!");
        return intval($tier);
    }

    private static function parseDate($timestamp)
    {
        return \DateTime::createFromFormat("m/d/Y H:i:s", $timestamp);
    }

} 