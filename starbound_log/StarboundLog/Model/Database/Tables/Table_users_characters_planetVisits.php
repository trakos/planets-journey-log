<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users_characters_planetVisits
 *
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits|null getRow($primaryId)
 */
class Table_users_characters_planetVisits extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users_characters_planetVisits());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'users_characters_planetVisits';
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
     * @return \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'chapla_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_users_characters_planetVisits) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
