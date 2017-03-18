<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 *
 * @ORM\Table(name="theme")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\ThemeRepository")
 */
class Theme
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
     * @ORM\Column(name="nom_theme", type="string", length=255)
     */
    private $nomTheme;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_theme", type="string", length=255)
     */
    private $statutTheme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_theme", type="datetime")
     */
    private $dateTheme;


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
     * Set nomTheme
     *
     * @param string $nomTheme
     * @return Theme
     */
    public function setNomTheme($nomTheme)
    {
        $this->nomTheme = $nomTheme;

        return $this;
    }

    /**
     * Get nomTheme
     *
     * @return string 
     */
    public function getNomTheme()
    {
        return $this->nomTheme;
    }

    /**
     * Set statutTheme
     *
     * @param string $statutTheme
     * @return Theme
     */
    public function setStatutTheme($statutTheme)
    {
        $this->statutTheme = $statutTheme;

        return $this;
    }

    /**
     * Get statutTheme
     *
     * @return string 
     */
    public function getStatutTheme()
    {
        return $this->statutTheme;
    }

    /**
     * Set dateTheme
     *
     * @param \DateTime $dateTheme
     * @return Theme
     */
    public function setDateTheme($dateTheme)
    {
        $this->dateTheme = $dateTheme;

        return $this;
    }

    /**
     * Get dateTheme
     *
     * @return \DateTime 
     */
    public function getDateTheme()
    {
        return $this->dateTheme;
    }

    public function __toString()
    {
        return $this->getNomTheme();
    }
}
