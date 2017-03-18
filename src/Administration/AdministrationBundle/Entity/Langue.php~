<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\LangueRepository")
 */
class Langue
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
     * @ORM\Column(name="nom_langue", type="string", length=255)
     */
    private $nomLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_langue", type="string", length=255)
     */
    private $statutLangue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_langue", type="datetime")
     */
    private $dateLangue;


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
     * Set nomLangue
     *
     * @param string $nomLangue
     * @return Langue
     */
    public function setNomLangue($nomLangue)
    {
        $this->nomLangue = $nomLangue;

        return $this;
    }

    /**
     * Get nomLangue
     *
     * @return string 
     */
    public function getNomLangue()
    {
        return $this->nomLangue;
    }

    /**
     * Set statutLangue
     *
     * @param string $statutLangue
     * @return Langue
     */
    public function setStatutLangue($statutLangue)
    {
        $this->statutLangue = $statutLangue;

        return $this;
    }

    /**
     * Get statutLangue
     *
     * @return string 
     */
    public function getStatutLangue()
    {
        return $this->statutLangue;
    }

    /**
     * Set dateLangue
     *
     * @param \DateTime $dateLangue
     * @return Langue
     */
    public function setDateLangue($dateLangue)
    {
        $this->dateLangue = $dateLangue;

        return $this;
    }

    /**
     * Get dateLangue
     *
     * @return \DateTime 
     */
    public function getDateLangue()
    {
        return $this->dateLangue;
    }

    public function __toString()
    {
        return $this->getNomLangue();
    }
}
