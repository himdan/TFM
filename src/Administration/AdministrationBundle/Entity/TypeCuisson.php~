<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeCuisson
 *
 * @ORM\Table(name="type_cuisson")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\TypeCuissonRepository")
 */
class TypeCuisson
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
     * @ORM\Column(name="nom_typeCuisson", type="string", length=255)
     */
    private $nomTypeCuisson;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_typeCuisson", type="string", length=255)
     */
    private $statutTypeCuisson;


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
     * Set nomTypeCuisson
     *
     * @param string $nomTypeCuisson
     *
     * @return TypeCuisson
     */
    public function setNomTypeCuisson($nomTypeCuisson)
    {
        $this->nomTypeCuisson = $nomTypeCuisson;

        return $this;
    }

    /**
     * Get nomTypeCuisson
     *
     * @return string
     */
    public function getNomTypeCuisson()
    {
        return $this->nomTypeCuisson;
    }

    /**
     * Set statutTypeCuisson
     *
     * @param string $statutTypeCuisson
     *
     * @return TypeCuisson
     */
    public function setStatutTypeCuisson($statutTypeCuisson)
    {
        $this->statutTypeCuisson = $statutTypeCuisson;

        return $this;
    }

    /**
     * Get statutTypeCuisson
     *
     * @return string
     */
    public function getStatutTypeCuisson()
    {
        return $this->statutTypeCuisson;
    }

    public function __toString()
    {
        return $this->getNomTypeCuisson();
    }
}
