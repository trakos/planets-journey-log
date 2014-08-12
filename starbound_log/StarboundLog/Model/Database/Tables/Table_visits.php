<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_visits
 *
 * @method \StarboundLog\Model\Database\Rows\Row_visits[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_visits|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_visits[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_visits|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_visits[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_visits|null getRow($primaryId)
 */
class Table_visits extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_visits());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'visits';
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
     * @return \StarboundLog\Model\Database\Rows\Row_visits
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_visits();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'visit_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_visits|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_visits) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
