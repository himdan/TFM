<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Difficulte
 *
 * @ORM\Table(name="difficulte")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\DifficulteRepository")
 */
class Difficulte
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
     * @ORM\Column(name="nom_difficulte", type="string", length=255)
     */
    private $nomDifficulte;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_difficulte", type="string", length=255)
     */
    private $statutDifficulte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_difficulte", type="datetime")
     */
    private $dateDifficulte;


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
     * Set nomDifficulte
     *
     * @param string $nomDifficulte
     * @return Difficulte
     */
    public function setNomDifficulte($nomDifficulte)
    {
        $this->nomDifficulte = $nomDifficulte;

        return $this;
    }

    /**
     * Get nomDifficulte
     *
     * @return string 
     */
    public function getNomDifficulte()
    {
        return $this->nomDifficulte;
    }

    /**
     * Set statutDifficulte
     *
     * @param string $statutDifficulte
     * @return Difficulte
     */
    public function setStatutDifficulte($statutDifficulte)
    {
        $this->statutDifficulte = $statutDifficulte;

        return $this;
    }

    /**
     * Get statutDifficulte
     *
     * @return string 
     */
    public function getStatutDifficulte()
    {
        return $this->statutDifficulte;
    }

    /**
     * Set dateDifficulte
     *
     * @param \DateTime $dateDifficulte
     * @return Difficulte
     */
    public function setDateDifficulte($dateDifficulte)
    {
        $this->dateDifficulte = $dateDifficulte;

        return $this;
    }

    /**
     * Get dateDifficulte
     *
     * @return \DateTime 
     */
    public function getDateDifficulte()
    {
        return $this->dateDifficulte;
    }

    public function __toString()
    {
        return $this->getNomDifficulte();
    }
}
