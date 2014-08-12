<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_dictionary_surfaceMiniBiomes
 *
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes|null getRow($primaryId)
 */
class Table_dictionary_surfaceMiniBiomes extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_dictionary_surfaceMiniBiomes());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'dictionary_surfaceMiniBiomes';
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
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'surbiome_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_dictionary_surfaceMiniBiomes) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
