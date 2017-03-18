<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\MenuRepository")
 */
class Menu
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
     * @ORM\Column(name="nom_menu", type="string", length=255)
     */
    private $nomMenu;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_menu", type="string", length=255)
     */
    private $statutMenu;


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
     * Set nomMenu
     *
     * @param string $nomMenu
     *
     * @return Menu
     */
    public function setNomMenu($nomMenu)
    {
        $this->nomMenu = $nomMenu;

        return $this;
    }

    /**
     * Get nomMenu
     *
     * @return string
     */
    public function getNomMenu()
    {
        return $this->nomMenu;
    }

    /**
     * Set statutMenu
     *
     * @param string $statutMenu
     *
     * @return Menu
     */
    public function setStatutMenu($statutMenu)
    {
        $this->statutMenu = $statutMenu;

        return $this;
    }

    /**
     * Get statutMenu
     *
     * @return string
     */
    public function getStatutMenu()
    {
        return $this->statutMenu;
    }

    public function __toString()
    {
        return $this->getNomMenu();
    }
}
