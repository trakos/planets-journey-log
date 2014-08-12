<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users_favoritePlanets
 *
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets|null getRow($primaryId)
 */
class Table_users_favoritePlanets extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users_favoritePlanets());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'users_favoritePlanets';
    }

    /**
     *
     * @return \Zend\Db\Adapter\Adapter
     */
    public function getDbAdapter()
    {
        return \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'plafav_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_users_favoritePlanets) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
