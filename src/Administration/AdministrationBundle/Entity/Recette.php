<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recette
 *
 * @ORM\Table(name="recette")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\RecetteRepository")
 */
class Recette
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
    private $auteur;

    /**
     * @ORM\ManyToOne(targetEntity="Client\ClientBundle\Entity\Client", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $auteurUpdate;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\RecettePhotos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $photos;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\Ingredient", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Difficulte", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $difficulte;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Menu", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Prix", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Nationalite", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $nationalite;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\Theme", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\TypeCuisson", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $typecuisson;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\Saison", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $saison;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\SubCategorie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $subcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="preparation_recette", type="text", nullable=true)
     */
    private $preparationRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="visite_recette", type="string", length=255)
     */
    private $visiteRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="active_recette", type="string", length=255)
     */
    private $activeRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="description_recette", type="text", nullable=true)
     */
    private $descriptionRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="description_ingredient_recette", type="text", nullable=true)
     */
    private $descriptionIngredientRecette;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_recette", type="datetime")
     */
    private $dateRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recette", type="string", length=255, nullable=true)
     */
    private $nomRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_recette", type="string", length=255, nullable=true)
     */
    private $statutRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="cuisson_recette", type="string", length=255, nullable=true)
     */
    private $cuissonRecette;

    /**
     * @var string
     *
     * @ORM\Column(name="rendement_recette", type="string", length=255, nullable=true)
     */
    private $rendementRecette;

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
     * Set descriptionRecette
     *
     * @param string $descriptionRecette
     * @return Recette
     */
    public function setDescriptionRecette($descriptionRecette)
    {
        $this->descriptionRecette = $descriptionRecette;

        return $this;
    }

    /**
     * Get descriptionRecette
     *
     * @return string
     */
    public function getDescriptionRecette()
    {
        return $this->descriptionRecette;
    }

    /**
     * Set dateRecette
     *
     * @param \DateTime $dateRecette
     * @return Recette
     */
    public function setDateRecette($dateRecette)
    {
        $this->dateRecette = $dateRecette;

        return $this;
    }

    /**
     * Get dateRecette
     *
     * @return \DateTime
     */
    public function getDateRecette()
    {
        return $this->dateRecette;
    }

    /**
     * Set statutRecette
     *
     * @param string $statutRecette
     * @return Recette
     */
    public function setStatutRecette($statutRecette)
    {
        $this->statutRecette = $statutRecette;

        return $this;
    }

    /**
     * Get statutRecette
     *
     * @return string
     */
    public function getStatutRecette()
    {
        return $this->statutRecette;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setVisiteRecette('0');
        $this->setActiveRecette(0);
        $this->ingredient = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theme = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set cuissonRecette
     *
     * @param string $cuissonRecette
     * @return Recette
     */
    public function setCuissonRecette($cuissonRecette)
    {
        $this->cuissonRecette = $cuissonRecette;

        return $this;
    }

    /**
     * Get cuissonRecette
     *
     * @return string
     */
    public function getCuissonRecette()
    {
        return $this->cuissonRecette;
    }

    /**
     * Add ingredient
     *
     * @param \Administration\AdministrationBundle\Entity\Ingredient $ingredient
     * @return Recette
     */
    public function addIngredient(\Administration\AdministrationBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredient[] = $ingredient;

        return $this;
    }

    /**
     * Remove ingredient
     *
     * @param \Administration\AdministrationBundle\Entity\Ingredient $ingredient
     */
    public function removeIngredient(\Administration\AdministrationBundle\Entity\Ingredient $ingredient)
    {
        $this->ingredient->removeElement($ingredient);
    }

    /**
     * Get ingredient
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }

    /**
     * Set difficulte
     *
     * @param \Administration\AdministrationBundle\Entity\Difficulte $difficulte
     * @return Recette
     */
    public function setDifficulte(\Administration\AdministrationBundle\Entity\Difficulte $difficulte)
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    /**
     * Get difficulte
     *
     * @return \Administration\AdministrationBundle\Entity\Difficulte
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * Set nationalite
     *
     * @param \Administration\AdministrationBundle\Entity\Nationalite $nationalite
     * @return Recette
     */
    public function setNationalite(\Administration\AdministrationBundle\Entity\Nationalite $nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return \Administration\AdministrationBundle\Entity\Nationalite
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }


    /**
     * Set image
     *
     * @param \Administration\AdministrationBundle\Entity\Media $image
     * @return Recette
     */
    public function setImage(\Administration\AdministrationBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Administration\AdministrationBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set nomRecette
     *
     * @param string $nomRecette
     * @return Recette
     */
    public function setNomRecette($nomRecette)
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    /**
     * Get nomRecette
     *
     * @return string
     */
    public function getNomRecette()
    {
        return $this->nomRecette;
    }

    /**
     * Set preparationRecette
     *
     * @param string $preparationRecette
     * @return Recette
     */
    public function setPreparationRecette($preparationRecette)
    {
        $this->preparationRecette = $preparationRecette;

        return $this;
    }

    /**
     * Get preparationRecette
     *
     * @return string
     */
    public function getPreparationRecette()
    {
        return $this->preparationRecette;
    }

    /**
     * Set auteur
     *
     * @param \Client\ClientBundle\Entity\Client $auteur
     * @return Recette
     */
    public function setAuteur(\Client\ClientBundle\Entity\Client $auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    public function __toString()
    {
        return $this->getNomRecette();
    }

    /**
     * Add theme
     *
     * @param \Administration\AdministrationBundle\Entity\Theme $theme
     *
     * @return Recette
     */
    public function addTheme(\Administration\AdministrationBundle\Entity\Theme $theme)
    {
        $this->theme[] = $theme;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \Administration\AdministrationBundle\Entity\Theme $theme
     */
    public function removeTheme(\Administration\AdministrationBundle\Entity\Theme $theme)
    {
        $this->theme->removeElement($theme);
    }

    /**
     * Get theme
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set prix
     *
     * @param \Administration\AdministrationBundle\Entity\Prix $prix
     *
     * @return Recette
     */
    public function setPrix(\Administration\AdministrationBundle\Entity\Prix $prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return \Administration\AdministrationBundle\Entity\Prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Add typecuisson
     *
     * @param \Administration\AdministrationBundle\Entity\TypeCuisson $typecuisson
     *
     * @return Recette
     */
    public function addTypecuisson(\Administration\AdministrationBundle\Entity\TypeCuisson $typecuisson)
    {
        $this->typecuisson[] = $typecuisson;

        return $this;
    }

    /**
     * Remove typecuisson
     *
     * @param \Administration\AdministrationBundle\Entity\TypeCuisson $typecuisson
     */
    public function removeTypecuisson(\Administration\AdministrationBundle\Entity\TypeCuisson $typecuisson)
    {
        $this->typecuisson->removeElement($typecuisson);
    }

    /**
     * Get typecuisson
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypecuisson()
    {
        return $this->typecuisson;
    }

    /**
     * Add saison
     *
     * @param \Administration\AdministrationBundle\Entity\Saison $saison
     *
     * @return Recette
     */
    public function addSaison(\Administration\AdministrationBundle\Entity\Saison $saison)
    {
        $this->saison[] = $saison;

        return $this;
    }

    /**
     * Remove saison
     *
     * @param \Administration\AdministrationBundle\Entity\Saison $saison
     */
    public function removeSaison(\Administration\AdministrationBundle\Entity\Saison $saison)
    {
        $this->saison->removeElement($saison);
    }

    /**
     * Get saison
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSaison()
    {
        return $this->saison;
    }

    /**
     * Add subcategorie
     *
     * @param \Administration\AdministrationBundle\Entity\SubCategorie $subcategorie
     *
     * @return Recette
     */
    public function addSubcategorie(\Administration\AdministrationBundle\Entity\SubCategorie $subcategorie)
    {
        $this->subcategorie[] = $subcategorie;

        return $this;
    }

    /**
     * Remove subcategorie
     *
     * @param \Administration\AdministrationBundle\Entity\SubCategorie $subcategorie
     */
    public function removeSubcategorie(\Administration\AdministrationBundle\Entity\SubCategorie $subcategorie)
    {
        $this->subcategorie->removeElement($subcategorie);
    }

    /**
     * Get subcategorie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategorie()
    {
        return $this->subcategorie;
    }

    /**
     * Set menu
     *
     * @param \Administration\AdministrationBundle\Entity\Menu $menu
     *
     * @return Recette
     */
    public function setMenu(\Administration\AdministrationBundle\Entity\Menu $menu)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Administration\AdministrationBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set descriptionIngredientRecette
     *
     * @param string $descriptionIngredientRecette
     *
     * @return Recette
     */
    public function setDescriptionIngredientRecette($descriptionIngredientRecette)
    {
        $this->descriptionIngredientRecette = $descriptionIngredientRecette;

        return $this;
    }

    /**
     * Get descriptionIngredientRecette
     *
     * @return string
     */
    public function getDescriptionIngredientRecette()
    {
        return $this->descriptionIngredientRecette;
    }

    /**
     * Set rendementRecette
     *
     * @param string $rendementRecette
     *
     * @return Recette
     */
    public function setRendementRecette($rendementRecette)
    {
        $this->rendementRecette = $rendementRecette;

        return $this;
    }

    /**
     * Get rendementRecette
     *
     * @return string
     */
    public function getRendementRecette()
    {
        return $this->rendementRecette;
    }


    /**
     * Set visiteRecette
     *
     * @param string $visiteRecette
     *
     * @return Recette
     */
    public function setVisiteRecette($visiteRecette)
    {
        $this->visiteRecette = $visiteRecette;

        return $this;
    }

    /**
     * Get visiteRecette
     *
     * @return string
     */
    public function getVisiteRecette()
    {
        return $this->visiteRecette;
    }

    /**
     * Add photo
     *
     * @param \Administration\AdministrationBundle\Entity\RecettePhotos $photo
     *
     * @return Recette
     */
    public function addPhoto(\Administration\AdministrationBundle\Entity\RecettePhotos $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Administration\AdministrationBundle\Entity\RecettePhotos $photo
     */
    public function removePhoto(\Administration\AdministrationBundle\Entity\RecettePhotos $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set activeRecette
     *
     * @param string $activeRecette
     *
     * @return Recette
     */
    public function setActiveRecette($activeRecette)
    {
        $this->activeRecette = $activeRecette;

        return $this;
    }

    /**
     * Get activeRecette
     *
     * @return string
     */
    public function getActiveRecette()
    {
        return $this->activeRecette;
    }

    /**
     * Set auteurUpdate
     *
     * @param \Client\ClientBundle\Entity\Client $auteurUpdate
     *
     * @return Recette
     */
    public function setAuteurUpdate(\Client\ClientBundle\Entity\Client $auteurUpdate)
    {
        $this->auteurUpdate = $auteurUpdate;

        return $this;
    }

    /**
     * Get auteurUpdate
     *
     * @return \Client\ClientBundle\Entity\Client
     */
    public function getAuteurUpdate()
    {
        return $this->auteurUpdate;
    }
}
