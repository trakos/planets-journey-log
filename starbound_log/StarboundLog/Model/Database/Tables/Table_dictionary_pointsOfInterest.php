<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_dictionary_pointsOfInterest
 *
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest[] fetchAll($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest|null fetchRow($q, $a)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest[] filterRows(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest|null filterRowsGetFirst(array $filterArray)
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest[] getAllRows()
 * @method \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest|null getRow($primaryId)
 */
class Table_dictionary_pointsOfInterest extends \Trks\Model\TrksAbstractTable
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_dictionary_pointsOfInterest());
    }

    /**
     *
     * @return string
     */
    public function getTableName()
    {
        return 'dictionary_pointsOfInterest';
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
     * @return \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest();
    }

    /**
     *
     * @return string
     */
    protected function getPrimaryKeyName()
    {
        return 'poi_id';
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest|\Trks\Model\TrksAbstractRow $row
     *
     * @throws \Exception
     * @return int
     */
    public function saveRow(\Trks\Model\TrksAbstractRow $row)
    {
        if (!$row instanceof \StarboundLog\Model\Database\Rows\Row_dictionary_pointsOfInterest) {
            throw new \Exception("Row is for a wrong table!");
        }
        return parent::saveRow($row);
    }
}
