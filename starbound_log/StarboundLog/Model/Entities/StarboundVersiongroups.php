<?php

namespace StarboundLog\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * StarboundVersiongroups
 *
 * @ORM\Table(name="starbound_versiongroups")
 * @ORM\Entity
 */
class StarboundVersiongroups
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vergroup_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vergroupId;

    /**
     * @var string
     *
     * @ORM\Column(name="vergroup_label", type="string", length=64, nullable=false)
     */
    private $vergroupLabel;



    /**
     * Get vergroupId
     *
     * @return integer 
     */
    public function getVergroupId()
    {
        return $this->vergroupId;
    }

    /**
     * Set vergroupLabel
     *
     * @param string $vergroupLabel
     * @return StarboundVersiongroups
     */
    public function setVergroupLabel($vergroupLabel)
    {
        $this->vergroupLabel = $vergroupLabel;
    
        return $this;
    }

    /**
     * Get vergroupLabel
     *
     * @return string 
     */
    public function getVergroupLabel()
    {
        return $this->vergroupLabel;
    }
}