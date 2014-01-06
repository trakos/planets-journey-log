<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_characters_queue
 *
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_characters_queue|null getRow($primaryId)
 */
class Table_characters_queue extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_characters_queue());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'characters_queue';
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
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_characters_queue();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'chaque_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_characters_queue|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_characters_queue) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
