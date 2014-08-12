<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planets_systems
 *
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_planets_systems|null getRow($primaryId)
 */
class Table_planets_systems extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planets_systems());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'planets_systems';
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
     * @return \StarboundLog\Model\Database\Rows\Row_planets_systems
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planets_systems();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'system_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_planets_systems|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_planets_systems) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
