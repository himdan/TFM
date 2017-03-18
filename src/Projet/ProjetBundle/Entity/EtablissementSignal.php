<?php

namespace Projet\ProjetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtablissementSignal
 *
 * @ORM\Table(name="etablissement_signal")
 * @ORM\Entity(repositoryClass="Projet\ProjetBundle\Repository\EtablissementSignalRepository")
 */
class EtablissementSignal
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
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $etablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_etablissementSignal", type="datetime")
     */
    private $dateEtablissementSignal;

    /**
     * @var string
     *
     * @ORM\Column(name="text_etablissementSignal", type="text")
     */
    private $textEtablissementSignal;


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
     * Set dateEtablissementSignal
     *
     * @param \DateTime $dateEtablissementSignal
     *
     * @return EtablissementSignal
     */
    public function setDateEtablissementSignal($dateEtablissementSignal)
    {
        $this->dateEtablissementSignal = $dateEtablissementSignal;

        return $this;
    }

    /**
     * Get dateEtablissementSignal
     *
     * @return \DateTime
     */
    public function getDateEtablissementSignal()
    {
        return $this->dateEtablissementSignal;
    }

    /**
     * Set textEtablissementSignal
     *
     * @param string $textEtablissementSignal
     *
     * @return EtablissementSignal
     */
    public function setTextEtablissementSignal($textEtablissementSignal)
    {
        $this->textEtablissementSignal = $textEtablissementSignal;

        return $this;
    }

    /**
     * Get textEtablissementSignal
     *
     * @return string
     */
    public function getTextEtablissementSignal()
    {
        return $this->textEtablissementSignal;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return EtablissementSignal
     */
    public function setClient(\Client\ClientBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set etablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $etablissement
     *
     * @return EtablissementSignal
     */
    public function setEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return \Administration\AdministrationBundle\Entity\Etablissement
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }
}
