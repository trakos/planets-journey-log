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
use StarboundLog\Model\Database\Proxies\Proxy_planets;
use StarboundLog\Model\Database\Rows\Row_planets;
use StarboundLog\Model\Database\Rows\Row_planets_visits;
use StarboundLog\Model\Database\Tables\Table_planets_visits;
use Zend\View\Model\ViewModel;

class Home extends MyAbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }


    public function csvAction()
    {
        $data = CsvImporter::read(T_PATH_DATA . '/coordinates.csv');
        foreach ($data as $entry) {
            $row = new Row_planets_visits();
            $planet = Proxy_planets::get()->getPlanet($entry->gameVersion, $entry->sector, $entry->xCoordinate, $entry->yCoordinate, $entry->planetNumber, $entry->planetMoon);
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
            $a = array($visit->visit_user_id, $visit->visit_planet_id);
            if (Table_planets_visits::get()->fetchRow($q, $a)) {
                continue;
            }
            $visit->save();
        }
        die();
    }
}
