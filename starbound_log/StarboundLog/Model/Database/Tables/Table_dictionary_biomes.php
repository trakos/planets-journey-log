<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_dictionary_biomes
 *
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|null getRow($primaryId)
 */
class Table_dictionary_biomes extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_dictionary_biomes());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'dictionary_biomes';
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
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_biomes
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_dictionary_biomes();
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
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_biomes|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_dictionary_biomes) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
