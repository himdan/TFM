<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\RegionRepository")
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Gouvernorat", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $gouvernorat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_region", type="string", length=255)
     */
    private $nomRegion;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomRegion
     *
     * @param string $nomRegion
     *
     * @return Region
     */
    public function setNomRegion($nomRegion)
    {
        $this->nomRegion = $nomRegion;

        return $this;
    }

    /**
     * Get nomRegion
     *
     * @return string
     */
    public function getNomRegion()
    {
        return $this->nomRegion;
    }


    /**
     * Set gouvernorat
     *
     * @param \Administration\AdministrationBundle\Entity\Gouvernorat $gouvernorat
     *
     * @return Region
     */
    public function setGouvernorat(\Administration\AdministrationBundle\Entity\Gouvernorat $gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return \Administration\AdministrationBundle\Entity\Gouvernorat
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    public function  __toString()
    {
        return $this->getNomRegion();
    }
}
