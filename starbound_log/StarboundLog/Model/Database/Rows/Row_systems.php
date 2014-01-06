<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_systems
 * 
 * 
 * name="systems"
 */
class Row_systems extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $system_id;

    /**
     * @var boolean
     */
    public $system_sector;

    /**
     * @var integer
     */
    public $system_x;

    /**
     * @var string
     */
    public $system_y;

    public $system_version_id;


    public function exchangeArray($data)
    {
        $this->system_id = (isset($data['system_id'])) ? $data['system_id'] : null;
        $this->system_sector = (isset($data['system_sector'])) ? $data['system_sector'] : null;
        $this->system_x = (isset($data['system_x'])) ? $data['system_x'] : null;
        $this->system_y = (isset($data['system_y'])) ? $data['system_y'] : null;
        $this->system_version_id = (isset($data['system_version_id'])) ? $data['system_version_id'] : null;
    }

    public function toArray()
    {
        return array(
            'system_id' => $this->system_id,
            'system_sector' => $this->system_sector,
            'system_x' => $this->system_x,
            'system_y' => $this->system_y,
            'system_version_id' => $this->system_version_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_systems::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_systems|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_systems::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_starbound_versions|null
     */
    public function getSystemVersion()
    {
        if (!$this->system_version_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_starbound_versions::get()->getRow($this->system_version_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_starbound_versions $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setSystemVersion($entity)
    {
        if (!$entity->version_id) throw new \Exception("Row has to be initialized!");
        $this->system_version_id = $entity->version_id;
    }

}
