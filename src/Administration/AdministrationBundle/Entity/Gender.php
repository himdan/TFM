<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gender
 *
 * @ORM\Table(name="gender")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\GenderRepository")
 */
class Gender
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
     * @ORM\Column(name="nom_gender", type="string", length=255)
     */
    private $nomGender;


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
     * Set nomGender
     *
     * @param string $nomGender
     *
     * @return Gender
     */
    public function setNomGender($nomGender)
    {
        $this->nomGender = $nomGender;

        return $this;
    }

    /**
     * Get nomGender
     *
     * @return string
     */
    public function getNomGender()
    {
        return $this->nomGender;
    }
}
