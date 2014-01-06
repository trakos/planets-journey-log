<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_systems
 *
 * @method \StarboundLog\Model\Database\Rows\Row_systems[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_systems|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_systems[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_systems|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_systems[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_systems|null getRow($primaryId)
 */
class Table_systems extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_systems());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'systems';
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
     * @return \StarboundLog\Model\Database\Rows\Row_systems
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_systems();
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
     * @param \StarboundLog\Model\Database\Rows\Row_systems|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_systems) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
