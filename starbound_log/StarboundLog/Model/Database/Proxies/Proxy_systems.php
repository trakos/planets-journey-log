<?php

namespace StarboundLog\Model\Database\Proxies;


use StarboundLog\Library\Security\MyAuth;
use StarboundLog\Model\Database\Entities\Entity_users;
use StarboundLog\Model\Database\Rows\Row_planets_favorites;
use StarboundLog\Model\Database\Rows\Row_systems;
use StarboundLog\Model\Database\Rows\Row_users;
use StarboundLog\Model\Database\Tables\Table_planets_favorites;
use StarboundLog\Model\Database\Tables\Table_systems;
use StarboundLog\Model\Database\Tables\Table_users;
use Zend\Db\Sql\Select;

/**
 * Class Proxy_planets_favorites
 *
 * @package StarboundLog\Model\Database\Proxies
 */
class Proxy_systems extends Table_systems
{
    /**
     * @var Proxy_systems
     */
    static private $instance;

    /**
     * @return Proxy_systems
     */
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Proxy_systems());
    }

    /**
     * @param $versionId
     * @param $systemSector
     * @param $systemX
     * @param $systemY
     *
     * @return Row_systems
     */
    public function getSystem($versionId, $systemSector, $systemX, $systemY)
    {
        $q   = 'SELECT
                  *
                FROM systems
                WHERE (system_version_id = ? OR (0 = ? AND system_version_id IS NULL)) AND system_sector = ? AND system_x = ? AND system_y = ?';
        $a   = array(
            $versionId,
            $versionId,
            $systemSector,
            $systemX,
            $systemY,
        );
        $row = $this->fetchRow($q, $a);
        if (!$row) {
            $row                    = new Row_systems();
            $row->system_sector     = $systemSector;
            $row->system_version_id = $versionId ? $versionId : NULL;
            $row->system_x          = $systemX;
            $row->system_y          = $systemY;
            $row->save();
        }
        return $row;
    }
} 