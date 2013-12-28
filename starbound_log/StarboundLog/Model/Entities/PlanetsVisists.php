<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanetsVisists
 *
 * @ORM\Table(name="planets_visists")
 * @ORM\Entity(repositoryClass="StarboundLog\Model\Repositories\PlanetsVisistsRepository")
 */
class PlanetsVisists extends \StarboundLog\Library\AbstractEntity
{
    /**
     * @return \StarboundLog\Model\Repositories\PlanetsVisistsRepository
     */
    static public function getRepo()
    {
        return \StarboundLog::getEntityManager()->getRepository('StarboundLog\Model\Entities\PlanetsVisists');
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="visit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $visitId;

    /**
     * @var string
     *
     * @ORM\Column(name="visit_name", type="string", length=256, nullable=false)
     */
    private $visitName;

    /**
     * @var integer
     *
     * @ORM\Column(name="visit_rating", type="integer", nullable=false)
     */
    private $visitRating;

    /**
     * @var integer
     *
     * @ORM\Column(name="visit_tier", type="integer", nullable=false)
     */
    private $visitTier;

    /**
     * @var string
     *
     * @ORM\Column(name="visit_comment", type="text", nullable=false)
     */
    private $visitComment;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visit_shared", type="boolean", nullable=false)
     */
    private $visitShared;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_created", type="datetime", nullable=false)
     */
    private $visitCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_updated", type="datetime", nullable=true)
     */
    private $visitUpdated;

    /**
     * @var \StarboundLog\Model\Entities\StarboundVersions
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\StarboundVersions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="visit_version_id", referencedColumnName="version_id")
     * })
     */
    private $visitVersion;

    /**
     * @var \StarboundLog\Model\Entities\Biomes
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Biomes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="visit_biome_id", referencedColumnName="biome_id")
     * })
     */
    private $visitBiome;

    /**
     * @var \StarboundLog\Model\Entities\Planets
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Planets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="visit_planet_id", referencedColumnName="planet_id")
     * })
     */
    private $visitPlanet;

    /**
     * @var \StarboundLog\Model\Entities\Users
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="visit_user_id", referencedColumnName="user_id")
     * })
     */
    private $visitUser;



    /**
     * Get visitId
     *
     * @return integer 
     */
    public function getVisitId()
    {
        return $this->visitId;
    }

    /**
     * Set visitName
     *
     * @param string $visitName
     * @return PlanetsVisists
     */
    public function setVisitName($visitName)
    {
        $this->visitName = $visitName;
    
        return $this;
    }

    /**
     * Get visitName
     *
     * @return string 
     */
    public function getVisitName()
    {
        return $this->visitName;
    }

    /**
     * Set visitRating
     *
     * @param integer $visitRating
     * @return PlanetsVisists
     */
    public function setVisitRating($visitRating)
    {
        $this->visitRating = $visitRating;
    
        return $this;
    }

    /**
     * Get visitRating
     *
     * @return integer 
     */
    public function getVisitRating()
    {
        return $this->visitRating;
    }

    /**
     * Set visitTier
     *
     * @param integer $visitTier
     * @return PlanetsVisists
     */
    public function setVisitTier($visitTier)
    {
        $this->visitTier = $visitTier;
    
        return $this;
    }

    /**
     * Get visitTier
     *
     * @return integer 
     */
    public function getVisitTier()
    {
        return $this->visitTier;
    }

    /**
     * Set visitComment
     *
     * @param string $visitComment
     * @return PlanetsVisists
     */
    public function setVisitComment($visitComment)
    {
        $this->visitComment = $visitComment;
    
        return $this;
    }

    /**
     * Get visitComment
     *
     * @return string 
     */
    public function getVisitComment()
    {
        return $this->visitComment;
    }

    /**
     * Set visitShared
     *
     * @param boolean $visitShared
     * @return PlanetsVisists
     */
    public function setVisitShared($visitShared)
    {
        $this->visitShared = $visitShared;
    
        return $this;
    }

    /**
     * Get visitShared
     *
     * @return boolean 
     */
    public function getVisitShared()
    {
        return $this->visitShared;
    }

    /**
     * Set visitCreated
     *
     * @param \DateTime $visitCreated
     * @return PlanetsVisists
     */
    public function setVisitCreated($visitCreated)
    {
        $this->visitCreated = $visitCreated;
    
        return $this;
    }

    /**
     * Get visitCreated
     *
     * @return \DateTime 
     */
    public function getVisitCreated()
    {
        return $this->visitCreated;
    }

    /**
     * Set visitUpdated
     *
     * @param \DateTime $visitUpdated
     * @return PlanetsVisists
     */
    public function setVisitUpdated($visitUpdated)
    {
        $this->visitUpdated = $visitUpdated;
    
        return $this;
    }

    /**
     * Get visitUpdated
     *
     * @return \DateTime 
     */
    public function getVisitUpdated()
    {
        return $this->visitUpdated;
    }

    /**
     * Set visitVersion
     *
     * @param \StarboundLog\Model\Entities\StarboundVersions $visitVersion
     * @return PlanetsVisists
     */
    public function setVisitVersion(\StarboundLog\Model\Entities\StarboundVersions $visitVersion = null)
    {
        $this->visitVersion = $visitVersion;
    
        return $this;
    }

    /**
     * Get visitVersion
     *
     * @return \StarboundLog\Model\Entities\StarboundVersions 
     */
    public function getVisitVersion()
    {
        return $this->visitVersion;
    }

    /**
     * Set visitBiome
     *
     * @param \StarboundLog\Model\Entities\Biomes $visitBiome
     * @return PlanetsVisists
     */
    public function setVisitBiome(\StarboundLog\Model\Entities\Biomes $visitBiome = null)
    {
        $this->visitBiome = $visitBiome;
    
        return $this;
    }

    /**
     * Get visitBiome
     *
     * @return \StarboundLog\Model\Entities\Biomes 
     */
    public function getVisitBiome()
    {
        return $this->visitBiome;
    }

    /**
     * Set visitPlanet
     *
     * @param \StarboundLog\Model\Entities\Planets $visitPlanet
     * @return PlanetsVisists
     */
    public function setVisitPlanet(\StarboundLog\Model\Entities\Planets $visitPlanet = null)
    {
        $this->visitPlanet = $visitPlanet;
    
        return $this;
    }

    /**
     * Get visitPlanet
     *
     * @return \StarboundLog\Model\Entities\Planets 
     */
    public function getVisitPlanet()
    {
        return $this->visitPlanet;
    }

    /**
     * Set visitUser
     *
     * @param \StarboundLog\Model\Entities\Users $visitUser
     * @return PlanetsVisists
     */
    public function setVisitUser(\StarboundLog\Model\Entities\Users $visitUser = null)
    {
        $this->visitUser = $visitUser;
    
        return $this;
    }

    /**
     * Get visitUser
     *
     * @return \StarboundLog\Model\Entities\Users 
     */
    public function getVisitUser()
    {
        return $this->visitUser;
    }
}