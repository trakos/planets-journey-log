<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_characters_planets
 *
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_characters_planets|null getRow($primaryId)
 */
class Table_characters_planets extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_characters_planets());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'characters_planets';
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
     * @return \StarboundLog\Model\Database\Rows\Row_characters_planets
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_characters_planets();
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
     * @param \StarboundLog\Model\Database\Rows\Row_characters_planets|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_characters_planets) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
