<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\IngredientRepository")
 */
class Ingredient
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
     * @ORM\Column(name="nom_ingredient", type="string", length=255)
     */
    private $nomIngredient;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_ingredient", type="string", length=255)
     */
    private $statutIngredient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ingredient", type="datetime")
     */
    private $dateIngredient;


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
     * Set nomIngredient
     *
     * @param string $nomIngredient
     * @return Ingredient
     */
    public function setNomIngredient($nomIngredient)
    {
        $this->nomIngredient = $nomIngredient;

        return $this;
    }

    /**
     * Get nomIngredient
     *
     * @return string 
     */
    public function getNomIngredient()
    {
        return $this->nomIngredient;
    }

    /**
     * Set statutIngredient
     *
     * @param string $statutIngredient
     * @return Ingredient
     */
    public function setStatutIngredient($statutIngredient)
    {
        $this->statutIngredient = $statutIngredient;

        return $this;
    }

    /**
     * Get statutIngredient
     *
     * @return string 
     */
    public function getStatutIngredient()
    {
        return $this->statutIngredient;
    }

    /**
     * Set dateIngredient
     *
     * @param \DateTime $dateIngredient
     * @return Ingredient
     */
    public function setDateIngredient($dateIngredient)
    {
        $this->dateIngredient = $dateIngredient;

        return $this;
    }

    /**
     * Get dateIngredient
     *
     * @return \DateTime 
     */
    public function getDateIngredient()
    {
        return $this->dateIngredient;
    }

    public function __toString()
    {
        return $this->getNomIngredient();
    }
}
