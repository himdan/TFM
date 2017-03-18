<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amitie
 *
 * @ORM\Table(name="amitie")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\AmitieRepository")
 */
class Amitie
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
        $this->setAcceptAmitie('0');

    }

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $toClient;

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $fromClient;

    /**
     * @var string
     *
     * @ORM\Column(name="accept_amitie", type="string", length=255)
     */
    private $acceptAmitie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_amitie", type="datetime")
     */
    private $dateAmitie;


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
     * Set acceptAmitie
     *
     * @param string $acceptAmitie
     *
     * @return Amitie
     */
    public function setAcceptAmitie($acceptAmitie)
    {
        $this->acceptAmitie = $acceptAmitie;

        return $this;
    }

    /**
     * Get acceptAmitie
     *
     * @return string
     */
    public function getAcceptAmitie()
    {
        return $this->acceptAmitie;
    }

    /**
     * Set dateAmitie
     *
     * @param \DateTime $dateAmitie
     *
     * @return Amitie
     */
    public function setDateAmitie($dateAmitie)
    {
        $this->dateAmitie = $dateAmitie;

        return $this;
    }

    /**
     * Get dateAmitie
     *
     * @return \DateTime
     */
    public function getDateAmitie()
    {
        return $this->dateAmitie;
    }

    /**
     * Set toClient
     *
     * @param \Client\ClientBundle\Entity\Client $toClient
     *
     * @return Amitie
     */
    public function setToClient(\Client\ClientBundle\Entity\Client $toClient)
    {
        $this->toClient = $toClient;

        return $this;
    }

    /**
     * Get toClient
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getToClient()
    {
        return $this->toClient;
    }

    /**
     * Set fromClient
     *
     * @param \Client\ClientBundle\Entity\Client $fromClient
     *
     * @return Amitie
     */
    public function setFromClient(\Client\ClientBundle\Entity\Client $fromClient)
    {
        $this->fromClient = $fromClient;

        return $this;
    }

    /**
     * Get fromClient
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getFromClient()
    {
        return $this->fromClient;
    }

}
