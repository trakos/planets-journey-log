<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planets_favorites
 *
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_planets_favorites|null getRow($primaryId)
 */
class Table_planets_favorites extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planets_favorites());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'planets_favorites';
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
     * @return \StarboundLog\Model\Database\Rows\Row_planets_favorites
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planets_favorites();
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
     * @param \StarboundLog\Model\Database\Rows\Row_planets_favorites|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_planets_favorites) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
