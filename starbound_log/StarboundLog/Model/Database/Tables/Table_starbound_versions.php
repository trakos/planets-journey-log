<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_starbound_versions
 * 
 */
class Table_starbound_versions
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_starbound_versions());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new \StarboundLog\Model\Database\Rows\Row_starbound_versions());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('starbound_versions', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_starbound_versions());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions
     */
    public function fetchRow($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, new \StarboundLog\Model\Database\Rows\Row_starbound_versions());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions[]
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
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions
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
     * @param \StarboundLog\Model\Database\Rows\Row_starbound_versions $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_starbound_versions $row)
    {
        $data = array(
            'version_released' => $row->version_released,
            'version_label' => $row->version_label,
        );

        $id = (int)$row->version_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->version_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('version_id' => $id));
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
        $this->tableGateway->delete(array('version_id' => $id));
    }
}
