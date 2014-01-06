<?php

namespace StarboundLog\Model\Database\Proxies;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Tables\Table_planets_visits;

class Proxy_planets_visits extends Table_planets_visits
{
    /**
     * @var Proxy_planets_visits
     */
    static private $instance;

    /**
     * @return Proxy_planets_visits
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_planets_visits());
    }

    /**
     * @param      $planetId
     * @param null $userId
     *
     * @return null|Row_planets_visits
     */
    public function getVisit($planetId, $userId = null)
    {
        if (!$userId) {
            $userId = MyAuth::getIdentity()->user_id;
        }
        $q = 'SELECT * FROM planets_visits WHERE visit_planet_id = ? AND visit_user_id = ?';
        $a = array($planetId, $userId);
        return $this->fetchRow($q, $a);
    }
} 