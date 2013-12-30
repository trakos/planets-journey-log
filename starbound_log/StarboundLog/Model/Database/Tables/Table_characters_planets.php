<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_characters_planets
 * 
 */
class Table_characters_planets
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_characters_planets());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new \StarboundLog\Model\Database\Rows\Row_characters_planets());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('characters_planets', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_planets[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_characters_planets());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_planets
     */
    public function fetchRow($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_characters_planets());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_planets[]
     */
    public function getAllRows()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     *
     * @param $id
     *
     * @throws \Exception
     * @return \StarboundLog\Model\Database\Rows\Row_characters_planets
     */
    public function getRow($id)
    {
        $id  = (int) $id;
        $rowSet = $this->tableGateway->select(array('id' => $id));
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_characters_planets $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_characters_planets $row)
    {
        $data = array(
            'chapla_time' => $row->chapla_time,
            'chapla_notes' => $row->chapla_notes,
        );

        $id = (int)$row->chapla_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->chapla_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('chapla_id' => $id));
                return $id;
            } else {
                throw new \Exception('Row id does not exist');
            }
        }
    }

    /**
     * @param int $id
     */
    public function deleteRow($id)
    {
        $this->tableGateway->delete(array('chapla_id' => $id));
    }
}
