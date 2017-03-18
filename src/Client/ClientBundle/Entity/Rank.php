<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rank
 *
 * @ORM\Table(name="rank")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\RankRepository")
 */
class Rank
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
        $this->setDateRank(new \DateTime);
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
    private $rankRecette;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $rankArticle;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $rankEtablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rank", type="datetime")
     */
    private $dateRank;

    /**
     * @var string
     *
     * @ORM\Column(name="type_rank", type="string", length=255)
     */
    private $typeRank;

    /**
     * @var string
     *
     * @ORM\Column(name="nbr_rank", type="string", length=255)
     */
    private $nbrRank;


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
     * Set dateRank
     *
     * @param \DateTime $dateRank
     *
     * @return Rank
     */
    public function setDateRank($dateRank)
    {
        $this->dateRank = $dateRank;

        return $this;
    }

    /**
     * Get dateRank
     *
     * @return \DateTime
     */
    public function getDateRank()
    {
        return $this->dateRank;
    }

    /**
     * Set typeRank
     *
     * @param string $typeRank
     *
     * @return Rank
     */
    public function setTypeRank($typeRank)
    {
        $this->typeRank = $typeRank;

        return $this;
    }

    /**
     * Get typeRank
     *
     * @return string
     */
    public function getTypeRank()
    {
        return $this->typeRank;
    }

    /**
     * Set nbrRank
     *
     * @param string $nbrRank
     *
     * @return Rank
     */
    public function setNbrRank($nbrRank)
    {
        $this->nbrRank = $nbrRank;

        return $this;
    }

    /**
     * Get nbrRank
     *
     * @return string
     */
    public function getNbrRank()
    {
        return $this->nbrRank;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Rank
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
     * Set rankRecette
     *
     * @param \Administration\AdministrationBundle\Entity\Recette $rankRecette
     *
     * @return Rank
     */
    public function setRankRecette(\Administration\AdministrationBundle\Entity\Recette $rankRecette = null)
    {
        $this->rankRecette = $rankRecette;

        return $this;
    }

    /**
     * Get rankRecette
     *
     * @return \Administration\AdministrationBundle\Entity\Recette
     */
    public function getRankRecette()
    {
        return $this->rankRecette;
    }

    /**
     * Set rankArticle
     *
     * @param \Administration\AdministrationBundle\Entity\Article $rankArticle
     *
     * @return Rank
     */
    public function setRankArticle(\Administration\AdministrationBundle\Entity\Article $rankArticle = null)
    {
        $this->rankArticle = $rankArticle;

        return $this;
    }

    /**
     * Get rankArticle
     *
     * @return \Administration\AdministrationBundle\Entity\Article
     */
    public function getRankArticle()
    {
        return $this->rankArticle;
    }

    /**
     * Set rankEtablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $rankEtablissement
     *
     * @return Rank
     */
    public function setRankEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $rankEtablissement = null)
    {
        $this->rankEtablissement = $rankEtablissement;

        return $this;
    }

    /**
     * Get rankEtablissement
     *
     * @return \Administration\AdministrationBundle\Entity\Etablissement
     */
    public function getRankEtablissement()
    {
        return $this->rankEtablissement;
    }
}
