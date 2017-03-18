<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appreciation
 *
 * @ORM\Table(name="appreciation")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\AppreciationRepository")
 */
class Appreciation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public function __construct()
    {
        $this->setDateAppreciation(new \DateTime);
    }

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $client;
    
    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Recette", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $appreciationRecette;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $appreciationArticle;

    /**
     * @return mixed
     */
    public function getAppreciationPublication()
    {
        return $this->appreciationPublication;
    }

    /**
     * @param mixed $appreciationPublication
     */
    public function setAppreciationPublication($appreciationPublication)
    {
        $this->appreciationPublication = $appreciationPublication;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $appreciationEtablissement;


    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Publication", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $appreciationPublication;



    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Photos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $appreciationPhoto;

    /**
     * @return mixed
     */
    public function getAppreciationPhoto()
    {
        return $this->appreciationPhoto;
    }

    /**
     * @param mixed $appreciationPhoto
     */
    public function setAppreciationPhoto($appreciationPhoto)
    {
        $this->appreciationPhoto = $appreciationPhoto;
    }


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_appreciation", type="datetime")
     */
    private $dateAppreciation;

    /**
     * @var string
     *
     * @ORM\Column(name="type_appreciation", type="string", length=255)
     */
    private $typeAppreciation;

    /**
     * @var string
     *
     * @ORM\Column(name="aime_appreciation", type="string", length=255)
     */
    private $aimeAppreciation;

    /**
     * @var string
     *
     * @ORM\Column(name="naimePasAppreciation", type="string", length=255)
     */
    private $naimePasAppreciation;


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
     * Set dateAppreciation
     *
     * @param \DateTime $dateAppreciation
     *
     * @return Appreciation
     */
    public function setDateAppreciation($dateAppreciation)
    {
        $this->dateAppreciation = $dateAppreciation;

        return $this;
    }

    /**
     * Get dateAppreciation
     *
     * @return \DateTime
     */
    public function getDateAppreciation()
    {
        return $this->dateAppreciation;
    }

    /**
     * Set typeAppreciation
     *
     * @param string $typeAppreciation
     *
     * @return Appreciation
     */
    public function setTypeAppreciation($typeAppreciation)
    {
        $this->typeAppreciation = $typeAppreciation;

        return $this;
    }

    /**
     * Get typeAppreciation
     *
     * @return string
     */
    public function getTypeAppreciation()
    {
        return $this->typeAppreciation;
    }

    /**
     * Set aimeAppreciation
     *
     * @param string $aimeAppreciation
     *
     * @return Appreciation
     */
    public function setAimeAppreciation($aimeAppreciation)
    {
        $this->aimeAppreciation = $aimeAppreciation;

        return $this;
    }

    /**
     * Get aimeAppreciation
     *
     * @return string
     */
    public function getAimeAppreciation()
    {
        return $this->aimeAppreciation;
    }

    /**
     * Set naimePasAppreciation
     *
     * @param string $naimePasAppreciation
     *
     * @return Appreciation
     */
    public function setNaimePasAppreciation($naimePasAppreciation)
    {
        $this->naimePasAppreciation = $naimePasAppreciation;

        return $this;
    }

    /**
     * Get naimePasAppreciation
     *
     * @return string
     */
    public function getNaimePasAppreciation()
    {
        return $this->naimePasAppreciation;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Appreciation
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
     * Set appreciationRecette
     *
     * @param \Administration\AdministrationBundle\Entity\Recette $appreciationRecette
     *
     * @return Appreciation
     */
    public function setAppreciationRecette(\Administration\AdministrationBundle\Entity\Recette $appreciationRecette = null)
    {
        $this->appreciationRecette = $appreciationRecette;

        return $this;
    }

    /**
     * Get appreciationRecette
     *
     * @return \Administration\AdministrationBundle\Entity\Recette
     */
    public function getAppreciationRecette()
    {
        return $this->appreciationRecette;
    }

    /**
     * Set appreciationArticle
     *
     * @param \Administration\AdministrationBundle\Entity\Article $appreciationArticle
     *
     * @return Appreciation
     */
    public function setAppreciationArticle(\Administration\AdministrationBundle\Entity\Article $appreciationArticle = null)
    {
        $this->appreciationArticle = $appreciationArticle;

        return $this;
    }

    /**
     * Get appreciationArticle
     *
     * @return \Administration\AdministrationBundle\Entity\Article
     */
    public function getAppreciationArticle()
    {
        return $this->appreciationArticle;
    }

    /**
     * Set appreciationEtablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $appreciationEtablissement
     *
     * @return Appreciation
     */
    public function setAppreciationEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $appreciationEtablissement = null)
    {
        $this->appreciationEtablissement = $appreciationEtablissement;

        return $this;
    }

    /**
     * Get appreciationEtablissement
     *
     * @return \Administration\AdministrationBundle\Entity\Etablissement
     */
    public function getAppreciationEtablissement()
    {
        return $this->appreciationEtablissement;
    }
}
