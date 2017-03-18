<?php

namespace Client\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photographe
 *
 * @ORM\Table(name="photographe")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\PhotographeRepository")
 */
class Photographe
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
     * @var int
     *
     * @ORM\Column(name="nbr_point", type="integer")
     */
    private $nbrPoint;

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="type_photographe", type="string", length=255)
     */
    private $typePhotographe;

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
     * Set nbrPoint
     *
     * @param integer $nbrPoint
     *
     * @return Photographe
     */
    public function setNbrPoint($nbrPoint)
    {
        $this->nbrPoint = $nbrPoint;

        return $this;
    }

    /**
     * Get nbrPoint
     *
     * @return int
     */
    public function getNbrPoint()
    {
        return $this->nbrPoint;
    }

    /**
     * Set client
     *
     * @param \Client\ClientBundle\Entity\Client $client
     *
     * @return Photographe
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
     * Set typePhotographe
     *
     * @param string $typePhotographe
     *
     * @return Photographe
     */
    public function setTypePhotographe($typePhotographe)
    {
        $this->typePhotographe = $typePhotographe;

        return $this;
    }

    /**
     * Get typePhotographe
     *
     * @return string
     */
    public function getTypePhotographe()
    {
        return $this->typePhotographe;
    }
}
