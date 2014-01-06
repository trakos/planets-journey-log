<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users
 *
 * @method \StarboundLog\Model\Database\Rows\Row_users[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_users|null getRow($primaryId)
 */
class Table_users extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'users';
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
     * @return \StarboundLog\Model\Database\Rows\Row_users
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'user_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_users) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
