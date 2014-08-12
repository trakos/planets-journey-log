<?php

namespace StarboundLog\Model\Database\Proxies;


// all joins:
// ;
//


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Rows\Row_users_visits_rating;
use StarboundLog\Model\Database\Tables\Table_users_visits_rating;
use Zend\Db\Sql\Select;

class Proxy_users_visits_rating extends Table_users_visits_rating
{
    /**
     * @var Proxy_planets_visits
     */
    static private $instance;

    /**
     * @return Proxy_users_visits_rating
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_users_visits_rating());
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

    /**
     * @param Row_planets_visits|int $visit
     * @param null|Row_users|int     $user
     *
     * @return null|\StarboundLog\Model\Database\Rows\Row_users_visits_rating
     * @throws \Exception
     */
    public function getVisitRatingFrom($visit, $user = null)
    {
        if ($visit instanceof Row_planets_visits) {
            $visit = $visit->visit_id;
        }
        if ($user instanceof Row_users) {
            $user = $user->user_id;
        } else if (!$user) {
            if (!MyAuth::hasIdentity()) throw new \Exception("no identity and no user parameter given");
            $user = MyAuth::getIdentity()->user_id;
        }

        $q = 'SELECT * FROM users_visits_rating WHERE rating_visit_id = ? AND rating_user_id = ?';
        $a = array($visit, $user);
        return $this->fetchRow($q, $a);
    }

    /**
     * @param Row_planets_visits|int $visit
     *
     * @return array (rating_user_id => rating_mark)
     */
    public function getAllVisitRatings($visit)
    {
        if ($visit instanceof Row_planets_visits) {
            $visit = $visit->visit_id;
        }

        $q = 'SELECT * FROM users_visits_rating WHERE rating_visit_id = ?';
        $a = array($visit);
        $rows = $this->fetchAll($q, $a);

        $returnData = [];
        foreach ($rows as $row) {
            $returnData[$row->rating_user_id]  = $row->rating_mark;
        }
        return $returnData;
    }

    /**
     * @param Row_planets_visits|int $visit
     *
     * @return array (rating_user_id => rating_mark)
     */
    public function getVisitMark($visit)
    {
        return array_sum($this->getAllVisitRatings($visit));
    }

    /**
     * @param Row_planets_visits|int $visit
     * @param int                    $mark
     * @param null|Row_users|int     $user
     *
     * @throws \Exception
     */
    public function rateVisit($visit, $mark, $user = null)
    {
        if ($visit instanceof Row_planets_visits) {
            $visit = $visit->visit_id;
        }
        if ($user instanceof Row_users) {
            $user = $user->user_id;
        } else if (!$user) {
            if (!MyAuth::hasIdentity()) throw new \Exception("no identity and no user parameter given");
            $user = MyAuth::getIdentity()->user_id;
        }

        $rating = $this->getVisitRatingFrom($visit, $user);
        if (!$rating) {
            $rating = new Row_users_visits_rating();
            $rating->rating_user_id = $user;
            $rating->rating_visit_id = $visit;
        }
        $rating->rating_mark = $mark;
        $rating->save();
    }

    /**
     * @param Row_planets_visits|int $visit
     * @param null|Row_users|int     $user
     *
     * @throws \Exception
     */
    public function undoRateVisit($visit, $user = null)
    {
        if ($visit instanceof Row_planets_visits) {
            $visit = $visit->visit_id;
        }
        if ($user instanceof Row_users) {
            $user = $user->user_id;
        } else if (!$user) {
            if (!MyAuth::hasIdentity()) throw new \Exception("no identity and no user parameter given");
            $user = MyAuth::getIdentity()->user_id;
        }

        $rating = $this->getVisitRatingFrom($visit, $user);
        if ($rating) {
            $this->deleteRow($visit->visit_id);
        }
    }
} 