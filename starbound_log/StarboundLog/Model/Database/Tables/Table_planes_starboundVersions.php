<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planes_starboundVersions
 *
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions|null getRow($primaryId)
 */
class Table_planes_starboundVersions extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planes_starboundVersions());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'planes_starboundVersions';
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
     * @return \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions();
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
     * @param \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
