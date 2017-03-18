<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filtre
 *
 * @ORM\Table(name="filtre")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\FiltreRepository")
 */
class Filtre
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
     * @ORM\Column(name="nom_filtre", type="string", length=255)
     */
    private $nomFiltre;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_filtre", type="string", length=255)
     */
    private $statutFiltre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_filtre", type="datetime")
     */
    private $dateFiltre;


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
     * Set nomFiltre
     *
     * @param string $nomFiltre
     * @return Filtre
     */
    public function setNomFiltre($nomFiltre)
    {
        $this->nomFiltre = $nomFiltre;

        return $this;
    }

    /**
     * Get nomFiltre
     *
     * @return string 
     */
    public function getNomFiltre()
    {
        return $this->nomFiltre;
    }

    /**
     * Set statutFiltre
     *
     * @param string $statutFiltre
     * @return Filtre
     */
    public function setStatutFiltre($statutFiltre)
    {
        $this->statutFiltre = $statutFiltre;

        return $this;
    }

    /**
     * Get statutFiltre
     *
     * @return string 
     */
    public function getStatutFiltre()
    {
        return $this->statutFiltre;
    }

    /**
     * Set dateFiltre
     *
     * @param \DateTime $dateFiltre
     * @return Filtre
     */
    public function setDateFiltre($dateFiltre)
    {
        $this->dateFiltre = $dateFiltre;

        return $this;
    }

    /**
     * Get dateFiltre
     *
     * @return \DateTime 
     */
    public function getDateFiltre()
    {
        return $this->dateFiltre;
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
     * @return Filtre
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
        return $this->getNomFiltre();
    }
}
