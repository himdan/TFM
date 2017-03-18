<?php
// src/AppBundle/Entity/User.php

namespace Client\ClientBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Client\ClientBundle\Repository\ClientRepository")
 */
class Client extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /** @ORM\Column(name="google_id", type="string", length=255, nullable=true) */
    protected $google_id;

    /** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
    protected $google_access_token;

    /**
     * @var string
     *
     * @ORM\Column(name="apikey", type="string", length=255,unique=true,nullable=false)
     */
    protected $apikey;

    public function __construct()
    {

        $this->setVisiteClient('0');
        parent::__construct();
        $this->setDateAjoutClient(new \DateTime);
        // set the api key for new client
        $this->setApikey();

        // navigateur

        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
            $navig='Internet explorer';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
            $navig='Internet explorer';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
            $navig='Mozilla Firefox';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
            $navig='Google Chrome';
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
            $navig="Opera Mini";
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
            $navig="Opera";
        elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
            $navig="Safari";
        else
            $navig='autre';
        $this->setNavigateurClient($navig);

        // systeme d'exploitation

        $user_agent = getenv("HTTP_USER_AGENT");

        if (strpos($user_agent, "Win") !== FALSE)
            $os = "Windows";
        elseif ((strpos($user_agent, "Mac") !== FALSE) || (strpos($user_agent, "PPC") !== FALSE))
            $os = "Mac";
        elseif (strpos($user_agent, "Linux") !== FALSE)
            $os = "Linux";
        elseif (strpos($user_agent, "FreeBSD") !== FALSE)
            $os = "FreeBSD";
        elseif (strpos($user_agent, "SunOS") !== FALSE)
            $os = "SunOS";
        elseif (strpos($user_agent, "IRIX") !== FALSE)
            $os = "IRIX";
        elseif (strpos($user_agent, "BeOS") !== FALSE)
            $os = "BeOS";
        elseif (strpos($user_agent, "OS/2") !== FALSE)
            $os = "OS/2";
        elseif (strpos($user_agent, "AIX") !== FALSE)
            $os = "AIX";
        else
            $os = "Autre";
        $this->setOsClient($os);
    }

    /**
     * @ORM\OneToOne(targetEntity="Administration\AdministrationBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Region", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE", nullable=true)
     */
    private $region;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Gender", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Pays", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true,onDelete="CASCADE")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Gouvernorat", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE", nullable=true)
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToMany(targetEntity="Administration\AdministrationBundle\Entity\Photos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $photos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout_client", type="date")
     */
    private $dateAjoutClient;

    /**
     * @var string
     *
     * @ORM\Column(name="navigateur_client", type="string", length=100,nullable=true)
     */
    private $navigateurClient;

    /**
     * @var string
     *
     * @ORM\Column(name="os_client", type="string", length=100,nullable=true)
     */
    private $osClient;

    /**
     * @var string
     *
     * @ORM\Column(name="premium_client", type="string", length=100,nullable=true)
     */
    private $premiumClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_client", type="string", length=100,nullable=true)
     */
    private $nomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_client", type="string", length=100,nullable=true)
     */
    private $prenomClient;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_client", type="string", length=200,nullable=true)
     */
    private $adresseClient;

    /**
     * @var string
     *
     * @ORM\Column(name="visite_client", type="string", length=200)
     */
    private $visiteClient;

    /**
     * @var string
     *
     * @ORM\Column(name="date_naissance_client", type="string", length=100,nullable=true)
     */
    private $dateNaissanceClient;

    /**
     * @var string
     *
     * @ORM\Column(name="description_client", type="text",nullable=true)
     */
    private $descriptionClient;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile_client", type="string", length=100,nullable=true)
     */
    private $mobileClient;

    /**
     * @var string
     *
     * @ORM\Column(name="fixe_client", type="string", length=100,nullable=true)
     */
    private $fixeClient;

    /**
     * @var string
     *
     * @ORM\Column(name="fax_client", type="string", length=100,nullable=true)
     */
    private $faxClient;

    /**
     * @var string
     *
     * @ORM\Column(name="site_client", type="string", length=100,nullable=true)
     */
    private $siteClient;

    /**
     * @var string
     *
     * @ORM\Column(name="situation_client", type="string", length=100,nullable=true)
     */
    private $situationClient;

    /**
     * @var string
     *
     * @ORM\Column(name="lat_client", type="string", length=255,nullable=true)
     */
    private $latClient;

    /**
     * @var string
     *
     * @ORM\Column(name="long_client", type="string", length=255,nullable=true)
     */
    private $longClient;

    /**
     * Set dateAjoutClient
     *
     * @param \DateTime $dateAjoutClient
     * @return Client
     */
    public function setDateAjoutClient($dateAjoutClient)
    {
        $this->dateAjoutClient = $dateAjoutClient;

        return $this;
    }

    /**
     * Get dateAjoutClient
     *
     * @return \DateTime
     */
    public function getDateAjoutClient()
    {
        return $this->dateAjoutClient;
    }

    /**
     * Set navigateurClient
     *
     * @param string $navigateurClient
     * @return Client
     */
    public function setNavigateurClient($navigateurClient)
    {
        $this->navigateurClient = $navigateurClient;

        return $this;
    }

    /**
     * Get navigateurClient
     *
     * @return string
     */
    public function getNavigateurClient()
    {
        return $this->navigateurClient;
    }

    /**
     * Set nomClient
     *
     * @param string $nomClient
     * @return Client
     */
    public function setNomClient($nomClient)
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    /**
     * Get nomClient
     *
     * @return string
     */
    public function getNomClient()
    {
        return $this->nomClient;
    }

    /**
     * Set prenomClient
     *
     * @param string $prenomClient
     * @return Client
     */
    public function setPrenomClient($prenomClient)
    {
        $this->prenomClient = $prenomClient;

        return $this;
    }

    /**
     * Get prenomClient
     *
     * @return string
     */
    public function getPrenomClient()
    {
        return $this->prenomClient;
    }

    /**
     * Set adresseClient
     *
     * @param string $adresseClient
     * @return Client
     */
    public function setAdresseClient($adresseClient)
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }

    /**
     * Get adresseClient
     *
     * @return string
     */
    public function getAdresseClient()
    {
        return $this->adresseClient;
    }

    /**
     * Set dateNaissanceClient
     *
     * @param string $dateNaissanceClient
     * @return Client
     */
    public function setDateNaissanceClient($dateNaissanceClient)
    {
        $this->dateNaissanceClient = $dateNaissanceClient;

        return $this;
    }

    /**
     * Get dateNaissanceClient
     *
     * @return string
     */
    public function getDateNaissanceClient()
    {
        return $this->dateNaissanceClient;
    }

    /**
     * Set descriptionClient
     *
     * @param string $descriptionClient
     * @return Client
     */
    public function setDescriptionClient($descriptionClient)
    {
        $this->descriptionClient = $descriptionClient;

        return $this;
    }

    /**
     * Get descriptionClient
     *
     * @return string
     */
    public function getDescriptionClient()
    {
        return $this->descriptionClient;
    }

    /**
     * Set mobileClient
     *
     * @param string $mobileClient
     * @return Client
     */
    public function setMobileClient($mobileClient)
    {
        $this->mobileClient = $mobileClient;

        return $this;
    }

    /**
     * Get mobileClient
     *
     * @return string
     */
    public function getMobileClient()
    {
        return $this->mobileClient;
    }

    /**
     * Set fixeClient
     *
     * @param string $fixeClient
     * @return Client
     */
    public function setFixeClient($fixeClient)
    {
        $this->fixeClient = $fixeClient;

        return $this;
    }

    /**
     * Get fixeClient
     *
     * @return string
     */
    public function getFixeClient()
    {
        return $this->fixeClient;
    }

    /**
     * Set faxClient
     *
     * @param string $faxClient
     * @return Client
     */
    public function setFaxClient($faxClient)
    {
        $this->faxClient = $faxClient;

        return $this;
    }

    /**
     * Get faxClient
     *
     * @return string
     */
    public function getFaxClient()
    {
        return $this->faxClient;
    }

    /**
     * Set siteClient
     *
     * @param string $siteClient
     * @return Client
     */
    public function setSiteClient($siteClient)
    {
        $this->siteClient = $siteClient;

        return $this;
    }

    /**
     * Get siteClient
     *
     * @return string
     */
    public function getSiteClient()
    {
        return $this->siteClient;
    }

    /**
     * Set situationClient
     *
     * @param string $situationClient
     * @return Client
     */
    public function setSituationClient($situationClient)
    {
        $this->situationClient = $situationClient;

        return $this;
    }

    /**
     * Get situationClient
     *
     * @return string
     */
    public function getSituationClient()
    {
        return $this->situationClient;
    }

    /**
     * Set osClient
     *
     * @param string $osClient
     * @return Client
     */
    public function setOsClient($osClient)
    {
        $this->osClient = $osClient;

        return $this;
    }

    /**
     * Get osClient
     *
     * @return string
     */
    public function getOsClient()
    {
        return $this->osClient;
    }

    /**
     * Set image
     *
     * @param \Administration\AdministrationBundle\Entity\Media $image
     *
     * @return Client
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
     * Set premiumClient
     *
     * @param string $premiumClient
     *
     * @return Client
     */
    public function setPremiumClient($premiumClient)
    {
        $this->premiumClient = $premiumClient;

        return $this;
    }

    /**
     * Get premiumClient
     *
     * @return string
     */
    public function getPremiumClient()
    {
        return $this->premiumClient;
    }

    /**
     * Set visiteClient
     *
     * @param string $visiteClient
     *
     * @return Client
     */
    public function setVisiteClient($visiteClient)
    {
        $this->visiteClient = $visiteClient;

        return $this;
    }

    /**
     * Get visiteClient
     *
     * @return string
     */
    public function getVisiteClient()
    {
        return $this->visiteClient;
    }

    /**
     * Add photo
     *
     * @param \Administration\AdministrationBundle\Entity\Photos $photo
     *
     * @return Client
     */
    public function addPhoto(\Administration\AdministrationBundle\Entity\Photos $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \Administration\AdministrationBundle\Entity\Photos $photo
     */
    public function removePhoto(\Administration\AdministrationBundle\Entity\Photos $photo)
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
     * Set region
     *
     * @param \Administration\AdministrationBundle\Entity\Region $region
     *
     * @return Client
     */
    public function setRegion(\Administration\AdministrationBundle\Entity\Region $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return \Administration\AdministrationBundle\Entity\Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set gouvernorat
     *
     * @param \Administration\AdministrationBundle\Entity\Gouvernorat $gouvernorat
     *
     * @return Client
     */
    public function setGouvernorat(\Administration\AdministrationBundle\Entity\Gouvernorat $gouvernorat)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat
     *
     * @return \Administration\AdministrationBundle\Entity\Gouvernorat
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set gender
     *
     * @param \Administration\AdministrationBundle\Entity\Gender $gender
     *
     * @return Client
     */
    public function setGender(\Administration\AdministrationBundle\Entity\Gender $gender = null)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return \Administration\AdministrationBundle\Entity\Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set pays
     *
     * @param \Administration\AdministrationBundle\Entity\Pays $pays
     *
     * @return Client
     */
    public function setPays(\Administration\AdministrationBundle\Entity\Pays $pays = null)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return \Administration\AdministrationBundle\Entity\Pays
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set latClient
     *
     * @param string $latClient
     *
     * @return Client
     */
    public function setLatClient($latClient)
    {
        $this->latClient = $latClient;

        return $this;
    }

    /**
     * Get latClient
     *
     * @return string
     */
    public function getLatClient()
    {
        return $this->latClient;
    }

    /**
     * Set longClient
     *
     * @param string $longClient
     *
     * @return Client
     */
    public function setLongClient($longClient)
    {
        $this->longClient = $longClient;

        return $this;
    }

    /**
     * Get longClient
     *
     * @return string
     */
    public function getLongClient()
    {
        return $this->longClient;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Client
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return Client
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set googleId
     *
     * @param string $googleId
     *
     * @return Client
     */
    public function setGoogleId($googleId)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get googleId
     *
     * @return string
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set googleAccessToken
     *
     * @param string $googleAccessToken
     *
     * @return Client
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    /**
     * Set apikey
     *
     * @param string $apikey
     * @return Account
     */
    public function setApikey()
    {
        $this->apikey=md5(uniqid(null, true));

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getApiKey(){
        return $this->apikey;

    }
}
