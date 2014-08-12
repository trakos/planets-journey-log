<?php

namespace StarboundLog\Model\Database\Rows;

/**
 * Row_planes_starboundVersions
 * 
 * 
 * name="planes_starboundVersions"
 */
class Row_planes_starboundVersions extends \Trks\Model\TrksAbstractRow
{
    /**
     * @var integer
     */
    public $version_id;

    /**
     * @var \DateTime
     */
    public $version_released;

    /**
     * @var string
     */
    public $version_label;

    public $version_vergroup_id;


    public function exchangeArray($data)
    {
        $this->version_id = (isset($data['version_id'])) ? $data['version_id'] : null;
        $this->version_released = (isset($data['version_released'])) ? $data['version_released'] : null;
        $this->version_label = (isset($data['version_label'])) ? $data['version_label'] : null;
        $this->version_vergroup_id = (isset($data['version_vergroup_id'])) ? $data['version_vergroup_id'] : null;
    }

    public function toArray()
    {
        return array(
            'version_id' => $this->version_id,
            'version_released' => $this->version_released,
            'version_label' => $this->version_label,
            'version_vergroup_id' => $this->version_vergroup_id,
        );
    }

    /**
     *
     * @return void
     */
    public function save()
    {
        \StarboundLog\Model\Database\Tables\Table_planes_starboundVersions::get()->saveRow($this);
    }

    /**
     * @param int $primaryId
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planes_starboundVersions|null
     */
    static public function get($primaryId)
    {
        return \StarboundLog\Model\Database\Tables\Table_planes_starboundVersions::get()->getRow($primaryId);
    }


    /**
     *
     * @return \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups|null
     */
    public function getVersionVergroup()
    {
        if (!$this->version_vergroup_id) return null;
        return \StarboundLog\Model\Database\Tables\Table_planets_starboundVersionGroups::get()->getRow($this->version_vergroup_id);
    }

    /**
     *
     * @param \StarboundLog\Model\Database\Rows\Row_planets_starboundVersionGroups $entity
     *
     * @throws \Exception
     * @return void
     */
    public function setVersionVergroup($entity)
    {
        if (!$entity->vergroup_id) throw new \Exception("Row has to be initialized!");
        $this->version_vergroup_id = $entity->vergroup_id;
    }

}
