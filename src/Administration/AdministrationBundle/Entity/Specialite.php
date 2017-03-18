<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\SpecialiteRepository")
 */
class Specialite
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
     * @ORM\Column(name="nom_specialite", type="string", length=255)
     */
    private $nomSpecialite;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_specialite", type="string", length=255)
     */
    private $statutSpecialite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_specialite", type="date")
     */
    private $dateSpecialite;

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
     * Set nomSpecialite
     *
     * @param string $nomSpecialite
     * @return Specialite
     */
    public function setNomSpecialite($nomSpecialite)
    {
        $this->nomSpecialite = $nomSpecialite;

        return $this;
    }

    /**
     * Get nomSpecialite
     *
     * @return string 
     */
    public function getNomSpecialite()
    {
        return $this->nomSpecialite;
    }

    /**
     * Set statutSpecialite
     *
     * @param string $statutSpecialite
     * @return Specialite
     */
    public function setStatutSpecialite($statutSpecialite)
    {
        $this->statutSpecialite = $statutSpecialite;

        return $this;
    }

    /**
     * Get statutSpecialite
     *
     * @return string 
     */
    public function getStatutSpecialite()
    {
        return $this->statutSpecialite;
    }

    /**
     * Set dateSpecialite
     *
     * @param \DateTime $dateSpecialite
     * @return Specialite
     */
    public function setDateSpecialite($dateSpecialite)
    {
        $this->dateSpecialite = $dateSpecialite;

        return $this;
    }

    /**
     * Get dateSpecialite
     *
     * @return \DateTime 
     */
    public function getDateSpecialite()
    {
        return $this->dateSpecialite;
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
     * @return Specialite
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
        return $this->getNomSpecialite();
    }
}
