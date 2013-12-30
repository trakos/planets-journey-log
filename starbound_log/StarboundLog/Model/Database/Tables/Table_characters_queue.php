<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_characters_queue
 * 
 */
class Table_characters_queue
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_characters_queue());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new \StarboundLog\Model\Database\Rows\Row_characters_queue());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('characters_queue', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_characters_queue());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue
     */
    public function fetchRow($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_characters_queue());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue[]
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
     * @return \StarboundLog\Model\Database\Rows\Row_characters_queue
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
     * @param \StarboundLog\Model\Database\Rows\Row_characters_queue $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_characters_queue $row)
    {
        $data = array(
            'chaque_done' => $row->chaque_done,
        );

        $id = (int)$row->chaque_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->chaque_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('chaque_id' => $id));
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
        $this->tableGateway->delete(array('chaque_id' => $id));
    }
}
