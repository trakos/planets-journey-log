<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Biomes
 *
 * @ORM\Table(name="biomes")
 * @ORM\Entity(repositoryClass="StarboundLog\Model\Repositories\BiomesRepository")
 */
class Biomes extends \StarboundLog\Library\AbstractEntity
{
    /**
     * @return \StarboundLog\Model\Repositories\BiomesRepository
     */
    static public function getRepo()
    {
        return \StarboundLog::getEntityManager()->getRepository('StarboundLog\Model\Entities\Biomes');
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="biome_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $biomeId;

    /**
     * @var string
     *
     * @ORM\Column(name="biome_name", type="string", length=64, nullable=false)
     */
    private $biomeName;



    /**
     * Get biomeId
     *
     * @return integer 
     */
    public function getBiomeId()
    {
        return $this->biomeId;
    }

    /**
     * Set biomeName
     *
     * @param string $biomeName
     * @return Biomes
     */
    public function setBiomeName($biomeName)
    {
        $this->biomeName = $biomeName;
    
        return $this;
    }

    /**
     * Get biomeName
     *
     * @return string 
     */
    public function getBiomeName()
    {
        return $this->biomeName;
    }
}