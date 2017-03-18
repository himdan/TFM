<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discussion
 *
 * @ORM\Table(name="discussion")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\DiscussionRepository")
 */
class Discussion
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
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\MessageRelation", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $message;

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
     * @ORM\Column(name="date_discussion", type="datetime")
     */
    private $dateDiscussion;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_discussion", type="text")
     */
    private $texteDiscussion;


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
     * Set dateDiscussion
     *
     * @param \DateTime $dateDiscussion
     *
     * @return Discussion
     */
    public function setDateDiscussion($dateDiscussion)
    {
        $this->dateDiscussion = $dateDiscussion;

        return $this;
    }

    /**
     * Get dateDiscussion
     *
     * @return \DateTime
     */
    public function getDateDiscussion()
    {
        return $this->dateDiscussion;
    }

    /**
     * Set texteDiscussion
     *
     * @param string $texteDiscussion
     *
     * @return Discussion
     */
    public function setTexteDiscussion($texteDiscussion)
    {
        $this->texteDiscussion = $texteDiscussion;

        return $this;
    }

    /**
     * Get texteDiscussion
     *
     * @return string
     */
    public function getTexteDiscussion()
    {
        return $this->texteDiscussion;
    }

    /**
     * Set sender
     *
     * @param \Client\ClientBundle\Entity\Client $sender
     *
     * @return Discussion
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
     * @return Discussion
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
     * Set message
     *
     * @param \Client\ClientBundle\Entity\MessageRelation $message
     *
     * @return Discussion
     */
    public function setMessage(\Client\ClientBundle\Entity\MessageRelation $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \Client\ClientBundle\Entity\MessageRelation
     */
    public function getMessage()
    {
        return $this->message;
    }
}
