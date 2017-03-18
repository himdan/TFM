<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubCategorie
 *
 * @ORM\Table(name="sub_categorie")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\SubCategorieRepository")
 */
class SubCategorie
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
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Menu", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_subCategorie", type="string", length=255)
     */
    private $nomSubCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_subCategorie", type="string", length=255)
     */
    private $statutSubCategorie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_subCategorie", type="datetime")
     */
    private $dateSubCategorie;


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
     * Set nomSubCategorie
     *
     * @param string $nomSubCategorie
     * @return SubCategorie
     */
    public function setNomSubCategorie($nomSubCategorie)
    {
        $this->nomSubCategorie = $nomSubCategorie;

        return $this;
    }

    /**
     * Get nomSubCategorie
     *
     * @return string 
     */
    public function getNomSubCategorie()
    {
        return $this->nomSubCategorie;
    }

    /**
     * Set statutSubCategorie
     *
     * @param string $statutSubCategorie
     * @return SubCategorie
     */
    public function setStatutSubCategorie($statutSubCategorie)
    {
        $this->statutSubCategorie = $statutSubCategorie;

        return $this;
    }

    /**
     * Get statutSubCategorie
     *
     * @return string 
     */
    public function getStatutSubCategorie()
    {
        return $this->statutSubCategorie;
    }

    /**
     * Set dateSubCategorie
     *
     * @param \DateTime $dateSubCategorie
     * @return SubCategorie
     */
    public function setDateSubCategorie($dateSubCategorie)
    {
        $this->dateSubCategorie = $dateSubCategorie;

        return $this;
    }

    /**
     * Get dateSubCategorie
     *
     * @return \DateTime 
     */
    public function getDateSubCategorie()
    {
        return $this->dateSubCategorie;
    }

    /**
     * Set menu
     *
     * @param \Administration\AdministrationBundle\Entity\Menu $menu
     *
     * @return SubCategorie
     */
    public function setMenu(\Administration\AdministrationBundle\Entity\Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Administration\AdministrationBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    public function __toString()
    {
        return $this->getNomSubCategorie();
    }
}
