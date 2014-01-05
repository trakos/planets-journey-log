<?php

namespace StarboundLog\Model\Database\Tables;

/**
 * Table_users
 * 
 */
class Table_users
{
    static private $instance;
    static public function get()
    {
        return self::$instance ? : (self::$instance = new Table_users());
    }

    protected $tableGateway;

    public function __construct()
    {
        $dbAdapter = \StarboundLog::getApplication()->getServiceManager()->get('Zend\Db\Adapter\Adapter');
        $resultSetPrototype = new \Zend\Db\ResultSet\ResultSet();
        $resultSetPrototype->setArrayObjectPrototype($this->getPrototype());
        $this->tableGateway = new \Zend\Db\TableGateway\TableGateway('users', $dbAdapter, null, $resultSetPrototype);
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users[]
     */
    public function fetchAll($q, $a)
    {
        return \Trks\Singletons\TrksDbAdapter::get()->fetchAllPrototyped($q, $a, $this->getPrototype());
    }

    /**
     * @param $q
     * @param $a
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users
     */
    public function fetchRow($q, $a)
    {
        return \Trks\Singletons\TrksDbAdapter::get()->fetchRowPrototyped($q, $a, $this->getPrototype());
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users[]
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
     * @return \StarboundLog\Model\Database\Rows\Row_users
     */
    public function getRow($id)
    {
        $id  = (int) $id;
        $rowSet = $this->tableGateway->select(array('user_id' => $id));
        $row = $rowSet->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    /**
     * @param \StarboundLog\Model\Database\Rows\Row_users $row
     *
     * @throws \Exception
     * @return int Updated or inserted id.
     */
    public function saveRow(\StarboundLog\Model\Database\Rows\Row_users $row)
    {
        $data = array(
            'user_login' => $row->user_login,
            'user_password' => $row->user_password,
            'user_mail' => $row->user_mail,
        );

        $id = (int)$row->user_id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $row->user_id = (int)$this->tableGateway->lastInsertValue;
            return (int)$this->tableGateway->lastInsertValue;
        } else {
            if ($this->getRow($id)) {
                $this->tableGateway->update($data, array('user_id' => $id));
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
        $this->tableGateway->delete(array('user_id' => $id));
    }

    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_users
     */
    protected function getPrototype()
    {
        return new \StarboundLog\Model\Database\Rows\Row_users();
    }
}
