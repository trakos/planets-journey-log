<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_planets_visits
 * 
 */
class Table_planets_visits
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_planets_visits());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($this->getPrototype());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('planets_visits', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_visits[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\Singletons\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, $this->getPrototype());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_visits
     */
    public function fetchRow($q, $a)
    {
        return \Trks\Singletons\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, $this->getPrototype());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_visits[]
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
     * @return \StarboundLog\Model\Database\Rows\Row_planets_visits
     */
    public function getRow($id)
    {
        $id  = (int) $id;
        $rowSet = $this->tableGateway->select(array('visit_id' => $id));
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_planets_visits $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_planets_visits $row)
    {
        $data = array(
            'visit_name' => $row->visit_name,
            'visit_rating' => $row->visit_rating,
            'visit_tier' => $row->visit_tier,
            'visit_comment' => $row->visit_comment,
            'visit_shared' => $row->visit_shared,
            'visit_created' => $row->visit_created,
            'visit_updated' => $row->visit_updated,
        );

        $id = (int)$row->visit_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->visit_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('visit_id' => $id));
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
        $this->tableGateway->delete(array('visit_id' => $id));
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_visits
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_planets_visits();
    }
}
