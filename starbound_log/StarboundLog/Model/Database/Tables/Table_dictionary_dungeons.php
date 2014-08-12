<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_dictionary_dungeons
 *
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons|null getRow($primaryId)
 */
class Table_dictionary_dungeons extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_dictionary_dungeons());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'dictionary_dungeons';
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
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'dungeon_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_dictionary_dungeons) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
