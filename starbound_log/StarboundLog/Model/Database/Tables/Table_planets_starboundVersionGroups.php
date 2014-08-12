<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planets_starboundVersionGroups
 *
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|null getRow($primaryId)
 */
class Table_planets_starboundVersionGroups extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planets_starboundVersionGroups());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'planets_starboundVersionGroups';
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
     * @return \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups();
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
     * @param \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
