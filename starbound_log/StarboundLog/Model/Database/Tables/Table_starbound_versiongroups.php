<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_starbound_versiongroups
 *
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups|null getRow($primaryId)
 */
class Table_starbound_versiongroups extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_starbound_versiongroups());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'starbound_versiongroups';
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
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'vergroup_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
