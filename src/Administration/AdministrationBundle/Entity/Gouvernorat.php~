<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gouvernorat
 *
 * @ORM\Table(name="gouvernorat")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\GouvernoratRepository")
 */
class Gouvernorat
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
     * @ORM\Column(name="nom_gouvernorat", type="string", length=255)
     */
    private $nomGouvernorat;


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
     * Set nomGouvernorat
     *
     * @param string $nomGouvernorat
     *
     * @return Gouvernorat
     */
    public function setNomGouvernorat($nomGouvernorat)
    {
        $this->nomGouvernorat = $nomGouvernorat;

        return $this;
    }

    /**
     * Get nomGouvernorat
     *
     * @return string
     */
    public function getNomGouvernorat()
    {
        return $this->nomGouvernorat;
    }

    public function __toString()
    {
        return $this->getNomGouvernorat();
    }
}
