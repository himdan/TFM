<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 *
 * @ORM\Table(name="saison")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\SaisonRepository")
 */
class Saison
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
     * @ORM\Column(name="nom_saison", type="string", length=255)
     */
    private $nomSaison;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_saison", type="string", length=255)
     */
    private $statutSaison;


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
     * Set nomSaison
     *
     * @param string $nomSaison
     *
     * @return Saison
     */
    public function setNomSaison($nomSaison)
    {
        $this->nomSaison = $nomSaison;

        return $this;
    }

    /**
     * Get nomSaison
     *
     * @return string
     */
    public function getNomSaison()
    {
        return $this->nomSaison;
    }

    /**
     * Set statutSaison
     *
     * @param string $statutSaison
     *
     * @return Saison
     */
    public function setStatutSaison($statutSaison)
    {
        $this->statutSaison = $statutSaison;

        return $this;
    }

    /**
     * Get statutSaison
     *
     * @return string
     */
    public function getStatutSaison()
    {
        return $this->statutSaison;
    }

    public function __toString()
    {
        return $this->getNomSaison();
    }
}
