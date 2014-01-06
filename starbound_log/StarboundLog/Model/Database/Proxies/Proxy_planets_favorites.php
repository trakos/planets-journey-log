<?php

namespace StarboundLog\Model\Database\Proxies;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Entities\Entity_users;
use StarboundLog\Model\Database\Rows\Row_planets_favorites;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Tables\Table_planets_favorites;
use StarboundLog\Model\Database\Tables\Table_users;

/**
 * Class Proxy_planets_favorites
 *
 * @package StarboundLog\Model\Database\Proxies
 *
 */
class Proxy_planets_favorites extends Table_planets_favorites
{
    /**
     * @var Proxy_planets_favorites
     */
    static private $instance;

    /**
     * @return Proxy_planets_favorites
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_planets_favorites());
    }

    public function addFavorite($planetId, $userId = null)
    {
        if (!$userId) {
            $userId = MyAuth::getIdentity()->user_id;
        }
        if ($this->getFavorite($planetId, $userId)) {
            return;
        }
        $favorite = new Row_planets_favorites();
        $favorite->plafav_planet_id = $planetId;
        $favorite->plafav_user_id = $userId;
        $favorite->save();
    }

    public function hasFavorite($planetId, $userId = null)
    {
        return $this->getFavorite($planetId, $userId) != null;
    }

    public function getFavorite($planetId, $userId = null)
    {
        if (!$userId) {
            $userId = MyAuth::getIdentity()->user_id;
        }
        $q = 'SELECT * FROM planets_favorites WHERE plafav_planet_id = ? AND plafav_user_id = ?';
        $a = array($planetId, $userId);
        return $this->fetchRow($q, $a);
    }

    public function removeFavorite($planetId, $userId = null)
    {
        if (!$userId) {
            $userId = MyAuth::getIdentity()->user_id;
        }
        $favorite = $this->getFavorite($planetId, $userId);
        if (!$favorite) {
            return;
        }
        $this->deleteRow($favorite->plafav_id);
    }
} 