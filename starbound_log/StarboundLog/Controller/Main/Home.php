<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace StarboundLog\Controller\Main;

use StarboundLog\Library\Mvc\MyAbstractController;
use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\CsvImporter\CsvImporter;
use StarboundLog\Model\Database\Entities\Entity_users;
use StarboundLog\Model\Database\Proxies\Proxy_planets;
use StarboundLog\Model\Database\Proxies\Proxy_users;
use StarboundLog\Model\Database\Proxies\Proxy_users_visits_rating;
use StarboundLog\Model\Database\Rows\Row_planets;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Tables\Table_planets_visits;
use Zend\View\Model\ViewModel;

class Home extends MyAbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }


    const DEBUG_RANDOMIZE = true;

    public function csvAction()
    {

        $dummyUsers = [];
        if (self::DEBUG_RANDOMIZE) {
            for ($i = 0; $i <= 5; $i++) {
                $dummyUsers[$i] = $this->_createDummyUser($i);
            }
        }

        $data = CsvImporter::read(T_PATH_DATA . '/coordinates.csv');
        foreach ($data as $entry) {
            $planet                 = Proxy_planets::get()->getPlanet($entry->gameVersion, $entry->sector, $entry->xCoordinate, $entry->yCoordinate, $entry->planetNumber, $entry->planetMoon);
            $visit                  = new Row_planets_visits();
            $visit->visit_biome_id  = $entry->biome;
            $visit->visit_comment   = $entry->description . PHP_EOL . "Structures: " . PHP_EOL . PHP_EOL . $entry->mainStructure . PHP_EOL . "(originally added by " . $entry->addedBy . ")";
            $visit->visit_created   = $entry->timestamp->format(T_DATETIME_FORMAT_MYSQL);
            $visit->visit_name      = $entry->planetName;
            $visit->visit_planet_id = $planet->planet_id;
            $visit->visit_rating    = $entry->rating;
            $visit->visit_shared    = true;
            $visit->visit_tier      = $entry->tier;
            $visit->visit_user_id   = MyAuth::getIdentity()->user_id;

            $q = 'SELECT * FROM planets_visits WHERE visit_user_id = ? AND visit_planet_id = ?';

            if (self::DEBUG_RANDOMIZE) {
                for ($i = 0; $i <= 5; $i++) {

                    $planet = Proxy_planets::get()->getPlanet(mt_rand(1, 6), $entry->sector, $entry->xCoordinate + mt_rand(0, 1), $entry->yCoordinate + mt_rand(0, 1), $entry->planetNumber, $entry->planetMoon);
                    $a      = array($dummyUsers[$i]->user_id, $planet->planet_id);

                    $dummyVisit = Table_planets_visits::get()->fetchRow($q, $a);

                    if (!$dummyVisit) {
                        $dummyVisit                  = clone $visit;
                        $dummyVisit->visit_user_id   = $dummyUsers[$i]->user_id;
                        $dummyVisit->visit_biome_id  = mt_rand(1, 16);
                        $dummyVisit->visit_comment   = $dummyUsers[$i]->user_login;
                        $dummyVisit->visit_planet_id = $planet->planet_id;
                        $dummyVisit->visit_rating    = mt_rand(0, 2) - 1;
                        $dummyVisit->visit_shared    = mt_rand(0, 10) > 2;
                        $dummyVisit->visit_tier      = min(10, $dummyVisit->visit_tier + mt_rand(0, 2));
                        $dummyVisit->save();
                    }

                    for ($k = 0; $k <= 5; $k++) {
                        Proxy_users_visits_rating::get()->rateVisit($dummyVisit, mt_rand(-1, 1), $dummyUsers[$k]);
                    }
                }
            }


            $a = array($visit->visit_user_id, $visit->visit_planet_id);
            if (Table_planets_visits::get()->fetchRow($q, $a)) {
                continue;
            }
            $visit->save();
        }
        die();
    }

    protected function _createDummyUser($i)
    {
        $username = 'test' . $i;
        $q        = 'SELECT * FROM users WHERE user_login = ?';
        $a        = array($username);
        $user     = Proxy_users::get()->fetchRow($q, $a);
        if (!$user) {
            $user                     = new Entity_users();
            $user->user_login         = $username;
            $user->user_mail          = $username . '@example.com';
            $user->user_password      = '';
            $user->user_mailConfirmed = true;
            $user->save();
        }
        return $user;
    }
}
