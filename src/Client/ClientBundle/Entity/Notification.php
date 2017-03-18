<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\NotificationRepository")
 */
class Notification
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
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Publication", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $publication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_notification", type="datetime")
     */
    private $dateNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="description_notification", type="string", length=255)
     */
    private $descriptionNotification;

    /**
     * @var string
     *
     * @ORM\Column(name="lu_notification", type="string", length=100,nullable=true)
     */
    private $luNotification;

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
     * Set dateNotification
     *
     * @param \DateTime $dateNotification
     *
     * @return Notification
     */
    public function setDateNotification($dateNotification)
    {
        $this->dateNotification = $dateNotification;

        return $this;
    }

    /**
     * Get dateNotification
     *
     * @return \DateTime
     */
    public function getDateNotification()
    {
        return $this->dateNotification;
    }

    /**
     * Set descriptionNotification
     *
     * @param string $descriptionNotification
     *
     * @return Notification
     */
    public function setDescriptionNotification($descriptionNotification)
    {
        $this->descriptionNotification = $descriptionNotification;

        return $this;
    }

    /**
     * Get descriptionNotification
     *
     * @return string
     */
    public function getDescriptionNotification()
    {
        return $this->descriptionNotification;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Notification
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
     * Set publication
     *
     * @param \Client\ClientBundle\Entity\Publication $publication
     *
     * @return Notification
     */
    public function setPublication(\Client\ClientBundle\Entity\Publication $publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \Client\ClientBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set luNotification
     *
     * @param string $luNotification
     *
     * @return Notification
     */
    public function setLuNotification($luNotification)
    {
        $this->luNotification = $luNotification;

        return $this;
    }

    /**
     * Get luNotification
     *
     * @return string
     */
    public function getLuNotification()
    {
        return $this->luNotification;
    }
}
