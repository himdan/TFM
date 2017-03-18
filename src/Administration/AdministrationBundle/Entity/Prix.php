<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prix
 *
 * @ORM\Table(name="prix")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\PrixRepository")
 */
class Prix
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
     * @ORM\Column(name="nom_prix", type="string", length=255)
     */
    private $nomPrix;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_prix", type="string", length=255)
     */
    private $statutPrix;


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
     * Set nomPrix
     *
     * @param string $nomPrix
     *
     * @return Prix
     */
    public function setNomPrix($nomPrix)
    {
        $this->nomPrix = $nomPrix;

        return $this;
    }

    /**
     * Get nomPrix
     *
     * @return string
     */
    public function getNomPrix()
    {
        return $this->nomPrix;
    }

    /**
     * Set statutPrix
     *
     * @param string $statutPrix
     *
     * @return Prix
     */
    public function setStatutPrix($statutPrix)
    {
        $this->statutPrix = $statutPrix;

        return $this;
    }

    /**
     * Get statutPrix
     *
     * @return string
     */
    public function getStatutPrix()
    {
        return $this->statutPrix;
    }

    public function __toString()
    {
        return $this->getNomPrix();
    }
}
