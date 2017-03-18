<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Confidentialite
 *
 * @ORM\Table(name="confidentialite")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\ConfidentialiteRepository")
 */
class Confidentialite
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
     * @var string
     *
     * @ORM\Column(name="nom_confidentialite", type="string", length=255)
     */
    private $nomConfidentialite;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_confidentialite", type="string", length=255)
     */
    private $statutConfidentialite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_confidentialite", type="datetime")
     */
    private $dateConfidentialite;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomConfidentialite
     *
     * @param string $nomConfidentialite
     * @return Confidentialite
     */
    public function setNomConfidentialite($nomConfidentialite)
    {
        $this->nomConfidentialite = $nomConfidentialite;

        return $this;
    }

    /**
     * Get nomConfidentialite
     *
     * @return string 
     */
    public function getNomConfidentialite()
    {
        return $this->nomConfidentialite;
    }

    /**
     * Set statutConfidentialite
     *
     * @param string $statutConfidentialite
     * @return Confidentialite
     */
    public function setStatutConfidentialite($statutConfidentialite)
    {
        $this->statutConfidentialite = $statutConfidentialite;

        return $this;
    }

    /**
     * Get statutConfidentialite
     *
     * @return string 
     */
    public function getStatutConfidentialite()
    {
        return $this->statutConfidentialite;
    }

    /**
     * Set dateConfidentialite
     *
     * @param \DateTime $dateConfidentialite
     * @return Confidentialite
     */
    public function setDateConfidentialite($dateConfidentialite)
    {
        $this->dateConfidentialite = $dateConfidentialite;

        return $this;
    }

    /**
     * Get dateConfidentialite
     *
     * @return \DateTime 
     */
    public function getDateConfidentialite()
    {
        return $this->dateConfidentialite;
    }
}
