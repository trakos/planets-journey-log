<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users_visitsRating
 *
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_users_visitsRating|null getRow($primaryId)
 */
class Table_users_visitsRating extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users_visitsRating());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'users_visitsRating';
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
     * @return \StarboundLog\Model\Database\Rows\Row_users_visitsRating
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users_visitsRating();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'rating_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users_visitsRating|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_users_visitsRating) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
