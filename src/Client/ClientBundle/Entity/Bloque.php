<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bloque
 *
 * @ORM\Table(name="bloque")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\BloqueRepository")
 */
class Bloque
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
    private $toClient;

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $fromClient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_bloque", type="datetime")
     */
    private $dateBloque;


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
     * Set dateBloque
     *
     * @param \DateTime $dateBloque
     *
     * @return Bloque
     */
    public function setDateBloque($dateBloque)
    {
        $this->dateBloque = $dateBloque;

        return $this;
    }

    /**
     * Get dateBloque
     *
     * @return \DateTime
     */
    public function getDateBloque()
    {
        return $this->dateBloque;
    }

    /**
     * Set toClient
     *
     * @param \Client\ClientBundle\Entity\Client $toClient
     *
     * @return Bloque
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
     * @return Bloque
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
