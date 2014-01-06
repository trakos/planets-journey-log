<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users_characters
 *
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters|null getRow($primaryId)
 */
class Table_users_characters extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users_characters());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'users_characters';
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
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users_characters();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'character_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users_characters|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_users_characters) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
