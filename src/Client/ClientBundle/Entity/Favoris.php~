<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\FavorisRepository")
 */
class Favoris
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
        $this->setDateFavoris(new \DateTime);
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
    private $favorisRecette;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $favorisArticle;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $favorisEtablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_favoris", type="datetime")
     */
    private $dateFavoris;

    /**
     * @var string
     *
     * @ORM\Column(name="type_favoris", type="string", length=255)
     */
    private $typeFavoris;


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
     * Set dateFavoris
     *
     * @param \DateTime $dateFavoris
     *
     * @return Favoris
     */
    public function setDateFavoris($dateFavoris)
    {
        $this->dateFavoris = $dateFavoris;

        return $this;
    }

    /**
     * Get dateFavoris
     *
     * @return \DateTime
     */
    public function getDateFavoris()
    {
        return $this->dateFavoris;
    }

    /**
     * Set typeFavoris
     *
     * @param string $typeFavoris
     *
     * @return Favoris
     */
    public function setTypeFavoris($typeFavoris)
    {
        $this->typeFavoris = $typeFavoris;

        return $this;
    }

    /**
     * Get typeFavoris
     *
     * @return string
     */
    public function getTypeFavoris()
    {
        return $this->typeFavoris;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Favoris
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
     * Set favorisRecette
     *
     * @param \Administration\AdministrationBundle\Entity\Recette $favorisRecette
     *
     * @return Favoris
     */
    public function setFavorisRecette(\Administration\AdministrationBundle\Entity\Recette $favorisRecette = null)
    {
        $this->favorisRecette = $favorisRecette;

        return $this;
    }

    /**
     * Get favorisRecette
     *
     * @return \Administration\AdministrationBundle\Entity\Recette
     */
    public function getFavorisRecette()
    {
        return $this->favorisRecette;
    }

    /**
     * Set favorisArticle
     *
     * @param \Administration\AdministrationBundle\Entity\Article $favorisArticle
     *
     * @return Favoris
     */
    public function setFavorisArticle(\Administration\AdministrationBundle\Entity\Article $favorisArticle = null)
    {
        $this->favorisArticle = $favorisArticle;

        return $this;
    }

    /**
     * Get favorisArticle
     *
     * @return \Administration\AdministrationBundle\Entity\Article
     */
    public function getFavorisArticle()
    {
        return $this->favorisArticle;
    }

    /**
     * Set favorisEtablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $favorisEtablissement
     *
     * @return Favoris
     */
    public function setFavorisEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $favorisEtablissement = null)
    {
        $this->favorisEtablissement = $favorisEtablissement;

        return $this;
    }

    /**
     * Get favorisEtablissement
     *
     * @return \Administration\AdministrationBundle\Entity\Etablissement
     */
    public function getFavorisEtablissement()
    {
        return $this->favorisEtablissement;
    }
}
