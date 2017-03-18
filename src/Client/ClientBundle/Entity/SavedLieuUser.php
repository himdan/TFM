<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SavedLieuUser
 *
 * @ORM\Table(name="saved_lieu_user")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\SavedLieuUserRepository")
 */
class SavedLieuUser
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
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $etablissement;


    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $client;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_savedLieuUser", type="datetime", nullable=true)
     */
    private $dateSavedLieuUser;


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
     * Set dateSavedLieuUser
     *
     * @param \DateTime $dateSavedLieuUser
     *
     * @return SavedLieuUser
     */
    public function setDateSavedLieuUser($dateSavedLieuUser)
    {
        $this->dateSavedLieuUser = $dateSavedLieuUser;

        return $this;
    }

    /**
     * Get dateSavedLieuUser
     *
     * @return \DateTime
     */
    public function getDateSavedLieuUser()
    {
        return $this->dateSavedLieuUser;
    }

    /**
     * Set etablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $etablissement
     *
     * @return SavedLieuUser
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

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return SavedLieuUser
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
}
