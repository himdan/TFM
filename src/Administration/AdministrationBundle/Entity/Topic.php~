<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\TopicRepository")
 */
class Topic
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
     * @var string
     *
     * @ORM\Column(name="nom_topic", type="string", length=255)
     */
    private $nomTopic;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_topic", type="string", length=255)
     */
    private $statutTopic;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_topic", type="datetime")
     */
    private $dateTopic;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomTopic
     *
     * @param string $nomTopic
     * @return Topic
     */
    public function setNomTopic($nomTopic)
    {
        $this->nomTopic = $nomTopic;

        return $this;
    }

    /**
     * Get nomTopic
     *
     * @return string 
     */
    public function getNomTopic()
    {
        return $this->nomTopic;
    }

    /**
     * Set statutTopic
     *
     * @param string $statutTopic
     * @return Topic
     */
    public function setStatutTopic($statutTopic)
    {
        $this->statutTopic = $statutTopic;

        return $this;
    }

    /**
     * Get statutTopic
     *
     * @return string 
     */
    public function getStatutTopic()
    {
        return $this->statutTopic;
    }

    /**
     * Set dateTopic
     *
     * @param \DateTime $dateTopic
     * @return Topic
     */
    public function setDateTopic($dateTopic)
    {
        $this->dateTopic = $dateTopic;

        return $this;
    }

    /**
     * Get dateTopic
     *
     * @return \DateTime 
     */
    public function getDateTopic()
    {
        return $this->dateTopic;
    }

    public function __toString()
    {
        return $this->getNomTopic();
    }
}
