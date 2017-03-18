<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SignalRecette
 *
 * @ORM\Table(name="signal_recette")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\SignalRecetteRepository")
 */
class SignalRecette
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
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Recette", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $recette;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_SignalRecette", type="datetime")
     */
    private $dateSignalRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_SignalRecette", type="text")
     */
    private $texteSignalRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="objet_SignalRecette", type="string", length=255)
     */
    private $objetSignalRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_signal_recette", type="string", length=255)
     */
    private $niveauSignalRecette;

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
     * Set dateSignalRecette
     *
     * @param \DateTime $dateSignalRecette
     *
     * @return SignalRecette
     */
    public function setDateSignalRecette($dateSignalRecette)
    {
        $this->dateSignalRecette = $dateSignalRecette;

        return $this;
    }

    /**
     * Get dateSignalRecette
     *
     * @return \DateTime
     */
    public function getDateSignalRecette()
    {
        return $this->dateSignalRecette;
    }

    /**
     * Set texteSignalRecette
     *
     * @param string $texteSignalRecette
     *
     * @return SignalRecette
     */
    public function setTexteSignalRecette($texteSignalRecette)
    {
        $this->texteSignalRecette = $texteSignalRecette;

        return $this;
    }

    /**
     * Get texteSignalRecette
     *
     * @return string
     */
    public function getTexteSignalRecette()
    {
        return $this->texteSignalRecette;
    }

    /**
     * Set objetSignalRecette
     *
     * @param string $objetSignalRecette
     *
     * @return SignalRecette
     */
    public function setObjetSignalRecette($objetSignalRecette)
    {
        $this->objetSignalRecette = $objetSignalRecette;

        return $this;
    }

    /**
     * Get objetSignalRecette
     *
     * @return string
     */
    public function getObjetSignalRecette()
    {
        return $this->objetSignalRecette;
    }



    /**
     * Set recette
     *
     * @param \Administration\AdministrationBundle\Entity\Recette $recette
     *
     * @return SignalRecette
     */
    public function setRecette(\Administration\AdministrationBundle\Entity\Recette $recette = null)
    {
        $this->recette = $recette;

        return $this;
    }

    /**
     * Get recette
     *
     * @return \Administration\AdministrationBundle\Entity\Recette
     */
    public function getRecette()
    {
        return $this->recette;
    }

    /**
     * Set niveauSignalRecette
     *
     * @param string $niveauSignalRecette
     *
     * @return SignalRecette
     */
    public function setNiveauSignalRecette($niveauSignalRecette)
    {
        $this->niveauSignalRecette = $niveauSignalRecette;

        return $this;
    }

    /**
     * Get niveauSignalRecette
     *
     * @return string
     */
    public function getNiveauSignalRecette()
    {
        return $this->niveauSignalRecette;
    }

}
