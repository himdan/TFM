<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireSignal
 *
 * @ORM\Table(name="commentaire_signal")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\CommentaireSignalRepository")
 */
class CommentaireSignal
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
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\SignalRecette", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $signalRecette;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_CommentaireSignal", type="datetime")
     */
    private $dateCommentaireSignal;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_CommentaireSignal", type="text")
     */
    private $texteCommentaireSignal;

    /**
     * @var string
     *
     * @ORM\Column(name="vue_commentaire_signal", type="string", length=255)
     */
    private $vueCommentaireSignal;

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
     * Set dateCommentaireSignal
     *
     * @param \DateTime $dateCommentaireSignal
     *
     * @return CommentaireSignal
     */
    public function setDateCommentaireSignal($dateCommentaireSignal)
    {
        $this->dateCommentaireSignal = $dateCommentaireSignal;

        return $this;
    }

    /**
     * Get dateCommentaireSignal
     *
     * @return \DateTime
     */
    public function getDateCommentaireSignal()
    {
        return $this->dateCommentaireSignal;
    }

    /**
     * Set texteCommentaireSignal
     *
     * @param string $texteCommentaireSignal
     *
     * @return CommentaireSignal
     */
    public function setTexteCommentaireSignal($texteCommentaireSignal)
    {
        $this->texteCommentaireSignal = $texteCommentaireSignal;

        return $this;
    }

    /**
     * Get texteCommentaireSignal
     *
     * @return string
     */
    public function getTexteCommentaireSignal()
    {
        return $this->texteCommentaireSignal;
    }

    /**
     * Set user
     *
     * @param \Client\ClientBundle\Entity\Client $user
     *
     * @return CommentaireSignal
     */
    public function setUser(\Client\ClientBundle\Entity\Client $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set signalRecette
     *
     * @param \Administration\AdministrationBundle\Entity\SignalRecette $signalRecette
     *
     * @return CommentaireSignal
     */
    public function setSignalRecette(\Administration\AdministrationBundle\Entity\SignalRecette $signalRecette)
    {
        $this->signalRecette = $signalRecette;

        return $this;
    }

    /**
     * Get signalRecette
     *
     * @return \Administration\AdministrationBundle\Entity\SignalRecette
     */
    public function getSignalRecette()
    {
        return $this->signalRecette;
    }

    /**
     * Set vueCommentaireSignal
     *
     * @param string $vueCommentaireSignal
     *
     * @return CommentaireSignal
     */
    public function setVueCommentaireSignal($vueCommentaireSignal)
    {
        $this->vueCommentaireSignal = $vueCommentaireSignal;

        return $this;
    }

    /**
     * Get vueCommentaireSignal
     *
     * @return string
     */
    public function getVueCommentaireSignal()
    {
        return $this->vueCommentaireSignal;
    }
}
