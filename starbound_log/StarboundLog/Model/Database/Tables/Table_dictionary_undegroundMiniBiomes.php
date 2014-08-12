<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_dictionary_undegroundMiniBiomes
 *
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes|null getRow($primaryId)
 */
class Table_dictionary_undegroundMiniBiomes extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_dictionary_undegroundMiniBiomes());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'dictionary_undegroundMiniBiomes';
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
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'underbiome_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_dictionary_undegroundMiniBiomes) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
