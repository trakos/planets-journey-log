<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * StarboundVersions
 *
 * @ORM\Table(name="starbound_versions")
 * @ORM\Entity(repositoryClass="StarboundLog\Model\Repositories\StarboundVersionsRepository")
 */
class StarboundVersions extends \StarboundLog\Library\AbstractEntity
{
    /**
     * @return \StarboundLog\Model\Repositories\StarboundVersionsRepository
     */
    static public function getRepo()
    {
        return \StarboundLog::getEntityManager()->getRepository('StarboundLog\Model\Entities\StarboundVersions');
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="version_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $versionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="version_released", type="date", nullable=false)
     */
    private $versionReleased;

    /**
     * @var string
     *
     * @ORM\Column(name="version_label", type="string", length=64, nullable=false)
     */
    private $versionLabel;

    /**
     * @var \StarboundLog\Model\Entities\StarboundVersiongroups
     *
     * @ORM\ManyToOne(targetEntity="StarboundLog\Model\Entities\StarboundVersiongroups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="version_vergroup_id", referencedColumnName="vergroup_id")
     * })
     */
    private $versionVergroup;



    /**
     * Get versionId
     *
     * @return integer 
     */
    public function getVersionId()
    {
        return $this->versionId;
    }

    /**
     * Set versionReleased
     *
     * @param \DateTime $versionReleased
     * @return StarboundVersions
     */
    public function setVersionReleased($versionReleased)
    {
        $this->versionReleased = $versionReleased;
    
        return $this;
    }

    /**
     * Get versionReleased
     *
     * @return \DateTime 
     */
    public function getVersionReleased()
    {
        return $this->versionReleased;
    }

    /**
     * Set versionLabel
     *
     * @param string $versionLabel
     * @return StarboundVersions
     */
    public function setVersionLabel($versionLabel)
    {
        $this->versionLabel = $versionLabel;
    
        return $this;
    }

    /**
     * Get versionLabel
     *
     * @return string 
     */
    public function getVersionLabel()
    {
        return $this->versionLabel;
    }

    /**
     * Set versionVergroup
     *
     * @param \StarboundLog\Model\Entities\StarboundVersiongroups $versionVergroup
     * @return StarboundVersions
     */
    public function setVersionVergroup(\StarboundLog\Model\Entities\StarboundVersiongroups $versionVergroup = null)
    {
        $this->versionVergroup = $versionVergroup;
    
        return $this;
    }

    /**
     * Get versionVergroup
     *
     * @return \StarboundLog\Model\Entities\StarboundVersiongroups 
     */
    public function getVersionVergroup()
    {
        return $this->versionVergroup;
    }
}