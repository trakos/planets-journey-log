<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planets
 *
 * @method \StarboundLog\Model\Database\Rows\Row_planets[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_planets|null getRow($primaryId)
 */
class Table_planets extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planets());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'planets';
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
     * @return \StarboundLog\Model\Database\Rows\Row_planets
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planets();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'planet_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_planets|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_planets) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
