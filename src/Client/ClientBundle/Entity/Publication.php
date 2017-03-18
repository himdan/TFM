<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\PublicationPhotos", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=true)
     */
    private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime", nullable=true)
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_publication", type="text", nullable=true)
     */
    private $textePublication;


    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Etablissement", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $etablissement;

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

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
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Publication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set textePublication
     *
     * @param string $textePublication
     *
     * @return Publication
     */
    public function setTextePublication($textePublication)
    {
        $this->textePublication = $textePublication;

        return $this;
    }

    /**
     * Get textePublication
     *
     * @return string
     */
    public function getTextePublication()
    {
        return $this->textePublication;
    }

    /**
     * Set image
     *
     * @param \Client\ClientBundle\Entity\PublicationPhotos $image
     *
     * @return Publication
     */
    public function setImage(\Client\ClientBundle\Entity\PublicationPhotos $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Client\ClientBundle\Entity\PublicationPhotos
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set etablissement
     *
     * @param \Administration\AdministrationBundle\Entity\Etablissement $etablissement
     *
     * @return Publication
     */
    public function setEtablissement(\Administration\AdministrationBundle\Entity\Etablissement $etablissement = null)
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
