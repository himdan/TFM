<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SignalUser
 *
 * @ORM\Table(name="signal_user")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\SignalUserRepository")
 */
class SignalUser
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_signal_user", type="datetime")
     */
    private $dateSignalUser;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_signal_user", type="string", length=255)
     */
    private $texteSignalUser;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateSignalUser
     *
     * @param \DateTime $dateSignalUser
     *
     * @return SignalUser
     */
    public function setDateSignalUser($dateSignalUser)
    {
        $this->dateSignalUser = $dateSignalUser;

        return $this;
    }

    /**
     * Get dateSignalUser
     *
     * @return \DateTime
     */
    public function getDateSignalUser()
    {
        return $this->dateSignalUser;
    }

    /**
     * Set toClient
     *
     * @param \Client\ClientBundle\Entity\Client $toClient
     *
     * @return SignalUser
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
     * @return SignalUser
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

    /**
     * Set texteSignalUser
     *
     * @param string $texteSignalUser
     *
     * @return SignalUser
     */
    public function setTexteSignalUser($texteSignalUser)
    {
        $this->texteSignalUser = $texteSignalUser;

        return $this;
    }

    /**
     * Get texteSignalUser
     *
     * @return string
     */
    public function getTexteSignalUser()
    {
        return $this->texteSignalUser;
    }
}
