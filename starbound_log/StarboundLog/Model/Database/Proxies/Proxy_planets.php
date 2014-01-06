<?php

namespace StarboundLog\Model\Database\Proxies;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Entities\Entity_users;
use StarboundLog\Model\Database\Rows\Row_planets;
use StarboundLog\Model\Database\Rows\Row_planets_favorites;
use StarboundLog\Model\Database\Rows\Row_systems;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Tables\Table_planets;
use StarboundLog\Model\Database\Tables\Table_planets_favorites;
use StarboundLog\Model\Database\Tables\Table_systems;
use StarboundLog\Model\Database\Tables\Table_users;

/**
 * Class Proxy_planets_favorites
 *
 * @package StarboundLog\Model\Database\Proxies
 *
 */
class Proxy_planets extends Table_planets
{
    /**
     * @var Proxy_planets
     */
    static private $instance;

    /**
     * @return Proxy_planets
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_planets());
    }

    /**
     * @param $versionId
     * @param $systemSector
     * @param $systemX
     * @param $systemY
     * @param $planetNumber
     * @param $planetMoon
     *
     * @return Row_planets
     */
    public function getPlanet($versionId, $systemSector, $systemX, $systemY, $planetNumber, $planetMoon)
    {
        $system = Proxy_systems::get()->getSystem($versionId, $systemSector, $systemX, $systemY);
        return $this->getPlanetFromSystem($system->system_id, $planetNumber, $planetMoon);
    }

    /**
     * @param $systemId
     * @param $planetNumber
     * @param $planetMoon
     *
     * @return Row_planets
     */
    public function getPlanetFromSystem($systemId, $planetNumber, $planetMoon)
    {
        $q = 'SELECT * FROM planets WHERE planet_system_id = ? AND planet_number = ? AND planet_moon = ?';
        $a = array($systemId, $planetNumber, $planetMoon);
        $row = $this->fetchRow($q, $a);
        if (!$row) {
            $row = new Row_planets();
            $row->planet_system_id = $systemId;
            $row->planet_number = $planetNumber;
            $row->planet_moon = $planetMoon;
            $row->save();
        }
        return $row;
    }
} 