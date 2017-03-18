<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nationalite
 *
 * @ORM\Table(name="nationalite")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\NationaliteRepository")
 */
class Nationalite
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
     * @ORM\Column(name="nom_nationalite", type="string", length=255)
     */
    private $nomNationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_nationalite", type="string", length=255)
     */
    private $statutNationalite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_nationalite", type="datetime")
     */
    private $dateNationalite;


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
     * Set nomNationalite
     *
     * @param string $nomNationalite
     * @return Nationalite
     */
    public function setNomNationalite($nomNationalite)
    {
        $this->nomNationalite = $nomNationalite;

        return $this;
    }

    /**
     * Get nomNationalite
     *
     * @return string 
     */
    public function getNomNationalite()
    {
        return $this->nomNationalite;
    }

    /**
     * Set statutNationalite
     *
     * @param string $statutNationalite
     * @return Nationalite
     */
    public function setStatutNationalite($statutNationalite)
    {
        $this->statutNationalite = $statutNationalite;

        return $this;
    }

    /**
     * Get statutNationalite
     *
     * @return string 
     */
    public function getStatutNationalite()
    {
        return $this->statutNationalite;
    }

    /**
     * Set dateNationalite
     *
     * @param \DateTime $dateNationalite
     * @return Nationalite
     */
    public function setDateNationalite($dateNationalite)
    {
        $this->dateNationalite = $dateNationalite;

        return $this;
    }

    /**
     * Get dateNationalite
     *
     * @return \DateTime 
     */
    public function getDateNationalite()
    {
        return $this->dateNationalite;
    }

    public function __toString()
    {
        return $this->getNomNationalite();
    }
}
