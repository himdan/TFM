<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="nom_categorie", type="string", length=255)
     */
    private $nomCategorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_categorie", type="datetime")
     */
    private $dateCategorie;


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
     * Set nomCategorie
     *
     * @param string $nomCategorie
     * @return Categorie
     */
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * Get nomCategorie
     *
     * @return string 
     */
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    /**
     * Set dateCategorie
     *
     * @param \DateTime $dateCategorie
     * @return Categorie
     */
    public function setDateCategorie($dateCategorie)
    {
        $this->dateCategorie = $dateCategorie;

        return $this;
    }

    /**
     * Get dateCategorie
     *
     * @return \DateTime 
     */
    public function getDateCategorie()
    {
        return $this->dateCategorie;
    }

    public function __toString()
    {
        return $this->getNomCategorie();
    }
}
