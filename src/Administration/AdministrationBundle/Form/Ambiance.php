<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ambiance
 *
 * @ORM\Table(name="ambiance")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\AmbianceRepository")
 */
class Ambiance
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
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\Categorie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_ambiance", type="string", length=255)
     */
    private $nomAmbiance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ambiance", type="datetime")
     */
    private $dateAmbiance;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_ambiance", type="string", length=255)
     */
    private $statutAmbiance;


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
     * Set nomAmbiance
     *
     * @param string $nomAmbiance
     * @return Ambiance
     */
    public function setNomAmbiance($nomAmbiance)
    {
        $this->nomAmbiance = $nomAmbiance;

        return $this;
    }

    /**
     * Get nomAmbiance
     *
     * @return string 
     */
    public function getNomAmbiance()
    {
        return $this->nomAmbiance;
    }

    /**
     * Set dateAmbiance
     *
     * @param \DateTime $dateAmbiance
     * @return Ambiance
     */
    public function setDateAmbiance($dateAmbiance)
    {
        $this->dateAmbiance = $dateAmbiance;

        return $this;
    }

    /**
     * Get dateAmbiance
     *
     * @return \DateTime 
     */
    public function getDateAmbiance()
    {
        return $this->dateAmbiance;
    }

    /**
     * Set statutAmbiance
     *
     * @param string $statutAmbiance
     * @return Ambiance
     */
    public function setStatutAmbiance($statutAmbiance)
    {
        $this->statutAmbiance = $statutAmbiance;

        return $this;
    }

    /**
     * Get statutAmbiance
     *
     * @return string 
     */
    public function getStatutAmbiance()
    {
        return $this->statutAmbiance;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categorie
     *
     * @param \Administration\AdministrationBundle\Entity\Categorie $categorie
     * @return Ambiance
     */
    public function addCategorie(\Administration\AdministrationBundle\Entity\Categorie $categorie)
    {
        $this->categorie[] = $categorie;

        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \Administration\AdministrationBundle\Entity\Categorie $categorie
     */
    public function removeCategorie(\Administration\AdministrationBundle\Entity\Categorie $categorie)
    {
        $this->categorie->removeElement($categorie);
    }

    /**
     * Get categorie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    public function __toString()
    {
        return $this->getNomAmbiance();
    }
}
