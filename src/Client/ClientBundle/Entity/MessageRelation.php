<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessageRelation
 *
 * @ORM\Table(name="message_relation")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\MessageRelationRepository")
 */
class MessageRelation
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
    private $sender;

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $receiver;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_message_relation", type="datetime")
     */
    private $dateMessageRelation;

    /**
     * @var string
     *
     * @ORM\Column(name="last_message_relation", type="text")
     */
    private $lastMessageRelation;

    /**
     * @var string
     *
     * @ORM\Column(name="lu_message_relation", type="string", length=100,nullable=true)
     */
    private $luMessageRelation;

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
     * Set dateMessageRelation
     *
     * @param \DateTime $dateMessageRelation
     *
     * @return MessageRelation
     */
    public function setDateMessageRelation($dateMessageRelation)
    {
        $this->dateMessageRelation = $dateMessageRelation;

        return $this;
    }

    /**
     * Get dateMessageRelation
     *
     * @return \DateTime
     */
    public function getDateMessageRelation()
    {
        return $this->dateMessageRelation;
    }

    /**
     * Set lastMessageRelation
     *
     * @param string $lastMessageRelation
     *
     * @return MessageRelation
     */
    public function setLastMessageRelation($lastMessageRelation)
    {
        $this->lastMessageRelation = $lastMessageRelation;

        return $this;
    }

    /**
     * Get lastMessageRelation
     *
     * @return string
     */
    public function getLastMessageRelation()
    {
        return $this->lastMessageRelation;
    }

    /**
     * Set sender
     *
     * @param \Client\ClientBundle\Entity\Client $sender
     *
     * @return MessageRelation
     */
    public function setSender(\Client\ClientBundle\Entity\Client $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param \Client\ClientBundle\Entity\Client $receiver
     *
     * @return MessageRelation
     */
    public function setReceiver(\Client\ClientBundle\Entity\Client $receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set luMessageRelation
     *
     * @param string $luMessageRelation
     *
     * @return MessageRelation
     */
    public function setLuMessageRelation($luMessageRelation)
    {
        $this->luMessageRelation = $luMessageRelation;

        return $this;
    }

    /**
     * Get luMessageRelation
     *
     * @return string
     */
    public function getLuMessageRelation()
    {
        return $this->luMessageRelation;
    }
}
