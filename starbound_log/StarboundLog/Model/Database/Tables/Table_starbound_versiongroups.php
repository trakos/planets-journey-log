<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_starbound_versiongroups
 * 
 */
class Table_starbound_versiongroups
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_starbound_versiongroups());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($this->getPrototype());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('starbound_versiongroups', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, $this->getPrototype());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups
     */
    public function fetchRow($q, $a)
    {
        return \Trks\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, $this->getPrototype());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups[]
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
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups
     */
    public function getRow($id)
    {
        $id  = (int) $id;
        $rowSet = $this->tableGateway->select(array('vergroup_id' => $id));
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_starbound_versiongroups $row)
    {
        $data = array(
            'vergroup_label' => $row->vergroup_label,
        );

        $id = (int)$row->vergroup_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->vergroup_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('vergroup_id' => $id));
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
        $this->tableGateway->delete(array('vergroup_id' => $id));
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_starbound_versiongroups();
    }
}
