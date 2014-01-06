<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_starbound_versions
 *
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_starbound_versions|null getRow($primaryId)
 */
class Table_starbound_versions extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_starbound_versions());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'starbound_versions';
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
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_starbound_versions();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'version_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_starbound_versions|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_starbound_versions) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
