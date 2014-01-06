<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_biomes
 *
 * @method \StarboundLog\Model\Database\Rows\Row_biomes[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_biomes|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_biomes[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_biomes|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_biomes[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_biomes|null getRow($primaryId)
 */
class Table_biomes extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_biomes());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'biomes';
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
     * @return \StarboundLog\Model\Database\Rows\Row_biomes
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_biomes();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'biome_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_biomes|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_biomes) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
