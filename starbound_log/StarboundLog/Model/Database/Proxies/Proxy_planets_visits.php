<?php

namespace StarboundLog\Model\Database\Proxies;


// all joins:
// ;
//


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Tables\Table_planets_visits;
use Zend\Db\Sql\Select;

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


    public function getAllVisits()
    {
        $q = 'SELECT
          visit_id,
          visit_user_id,
          visit_name,
          visit_rating,
          visit_comment,
          visit_rating,
          visit_tier,
          biome_name,
          user_login
        FROM planets_visits
          JOIN biomes ON visit_biome_id = biome_id
          JOIN users ON visit_user_id = user_id
          JOIN planets ON visit_planet_id = planet_id
          JOIN systems ON planet_system_id = system_id
          LEFT JOIN starbound_versions ON system_version_id = version_id
        WHERE system_version_id = ?';
    }

    /*public function getAllPlanets($gameVersionId)
    {
        $q = 'SELECT
  AVG(visit_rating) AS avg_visit_rating,
  COUNT(plafav_id)  AS count_visit_favorites,
  planets.*
FROM systems
  JOIN planets ON planet_system_id = system_id
  JOIN planets_visits ON visit_planet_id = planet_id
  LEFT JOIN planets_favorites ON plafav_planet_id = planet_id
WHERE system_version_id = ?
GROUP BY planet_id
ORDER BY visit_rating DESC';
    }*/

    /*public function getAllSystems($gameVersionId)
    {
        $q = 'SELECT
  planets.*,
  max_average_planet_rating,
  max_count_planet_favorites
FROM (SELECT
        planet_id AS max_planet_id,
        MAX(average_planet_rating)  AS max_average_planet_rating,
        MAX(count_planet_favorites) AS max_count_planet_favorites
      FROM (SELECT
              AVG(visit_rating) AS average_planet_rating,
              COUNT(plafav_id)  AS count_planet_favorites,
              planet_id
            FROM systems
              JOIN planets ON planet_system_id = system_id
              JOIN planets_visits ON visit_planet_id = planet_id
              LEFT JOIN planets_favorites ON plafav_planet_id = planet_id
            WHERE system_version_id = ?
            GROUP BY planet_id
            ORDER BY visit_rating DESC) sub_sub_planets) sub_planets
  JOIN planets ON planet_id = max_planet_id';
    }*/
} 