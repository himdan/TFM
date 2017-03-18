<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Recette", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $commentaireRecette;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $commentaireArticle;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $commentaireEtablissement;


    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Publication", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $commentairePublication;


    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Photos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $commentairePhoto;

    /**
     * @return mixed
     */
    public function getCommentairePhoto()
    {
        return $this->commentairePhoto;
    }

    /**
     * @param mixed $commentairePhoto
     */
    public function setCommentairePhoto($commentairePhoto)
    {
        $this->commentairePhoto = $commentairePhoto;
    }


    /**
     * @return mixed
     */
    public function getCommentairePublication()
    {
        return $this->commentairePublication;
    }

    /**
     * @param mixed $commentairePublication
     */
    public function setCommentairePublication($commentairePublication)
    {
        $this->commentairePublication = $commentairePublication;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_commentaire", type="datetime")
     */
    private $dateCommentaire;


    /**
     * @var string
     *
     * @ORM\Column(name="type_commentaire", type="string", length=255)
     */
    private $typeCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_commentaire", type="string", length=255)
     */
    private $texteCommentaire;


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
     * Set dateCommentaire
     *
     * @param \DateTime $dateCommentaire
     *
     * @return Commentaire
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return \DateTime
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set texteCommentaire
     *
     * @param string $texteCommentaire
     *
     * @return Commentaire
     */
    public function setTexteCommentaire($texteCommentaire)
    {
        $this->texteCommentaire = $texteCommentaire;

        return $this;
    }

    /**
     * Get texteCommentaire
     *
     * @return string
     */
    public function getTexteCommentaire()
    {
        return $this->texteCommentaire;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Commentaire
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
     * Set commentaireRecette
     *
     * @param \Administration\AdministrationBundle\Entity\Recette $commentaireRecette
     *
     * @return Commentaire
     */
    public function setCommentaireRecette(\Administration\AdministrationBundle\Entity\Recette $commentaireRecette = null)
    {
        $this->commentaireRecette = $commentaireRecette;

        return $this;
    }

    /**
     * Get commentaireRecette
     *
     * @return \Administration\AdministrationBundle\Entity\Recette
     */
    public function getCommentaireRecette()
    {
        return $this->commentaireRecette;
    }

    /**
     * Set commentaireArticle
     *
     * @param \Administration\AdministrationBundle\Entity\Article $commentaireArticle
     *
     * @return Commentaire
     */
    public function setCommentaireArticle(\Administration\AdministrationBundle\Entity\Article $commentaireArticle = null)
    {
        $this->commentaireArticle = $commentaireArticle;

        return $this;
    }

    /**
     * Get commentaireArticle
     *
     * @return \Administration\AdministrationBundle\Entity\Article
     */
    public function getCommentaireArticle()
    {
        return $this->commentaireArticle;
    }

    /**
     * Set commentaireEtablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $commentaireEtablissement
     *
     * @return Commentaire
     */
    public function setCommentaireEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $commentaireEtablissement = null)
    {
        $this->commentaireEtablissement = $commentaireEtablissement;

        return $this;
    }

    /**
     * Get commentaireEtablissement
     *
     * @return \Administration\AdministrationBundle\Entity\Etablissement
     */
    public function getCommentaireEtablissement()
    {
        return $this->commentaireEtablissement;
    }

    /**
     * Set typeCommentaire
     *
     * @param string $typeCommentaire
     *
     * @return Commentaire
     */
    public function setTypeCommentaire($typeCommentaire)
    {
        $this->typeCommentaire = $typeCommentaire;

        return $this;
    }

    /**
     * Get typeCommentaire
     *
     * @return string
     */
    public function getTypeCommentaire()
    {
        return $this->typeCommentaire;
    }
}
