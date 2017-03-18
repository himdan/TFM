<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\PaysRepository")
 */
class Pays
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
     * @ORM\Column(name="iso_pays", type="string", length=255, nullable=true)
     */
    private $isoPays;

    /**
     * @var string
     *
     * @ORM\Column(name="name_pays", type="string", length=255, nullable=true)
     */
    private $namePays;

    /**
     * @var string
     *
     * @ORM\Column(name="nice_name_pays", type="string", length=255, nullable=true)
     */
    private $niceNamePays;

    /**
     * @var string
     *
     * @ORM\Column(name="iso3pays", type="string", length=255, nullable=true)
     */
    private $iso3Pays;

    /**
     * @var string
     *
     * @ORM\Column(name="num_code_pays", type="string", length=255, nullable=true)
     */
    private $numCodePays;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_code_pays", type="string", length=255, nullable=true)
     */
    private $phoneCodePays;


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
     * Set isoPays
     *
     * @param string $isoPays
     *
     * @return Pays
     */
    public function setIsoPays($isoPays)
    {
        $this->isoPays = $isoPays;

        return $this;
    }

    /**
     * Get isoPays
     *
     * @return string
     */
    public function getIsoPays()
    {
        return $this->isoPays;
    }

    /**
     * Set namePays
     *
     * @param string $namePays
     *
     * @return Pays
     */
    public function setNamePays($namePays)
    {
        $this->namePays = $namePays;

        return $this;
    }

    /**
     * Get namePays
     *
     * @return string
     */
    public function getNamePays()
    {
        return $this->namePays;
    }

    /**
     * Set niceNamePays
     *
     * @param string $niceNamePays
     *
     * @return Pays
     */
    public function setNiceNamePays($niceNamePays)
    {
        $this->niceNamePays = $niceNamePays;

        return $this;
    }

    /**
     * Get niceNamePays
     *
     * @return string
     */
    public function getNiceNamePays()
    {
        return $this->niceNamePays;
    }

    /**
     * Set iso3Pays
     *
     * @param string $iso3Pays
     *
     * @return Pays
     */
    public function setIso3Pays($iso3Pays)
    {
        $this->iso3Pays = $iso3Pays;

        return $this;
    }

    /**
     * Get iso3Pays
     *
     * @return string
     */
    public function getIso3Pays()
    {
        return $this->iso3Pays;
    }

    /**
     * Set numCodePays
     *
     * @param string $numCodePays
     *
     * @return Pays
     */
    public function setNumCodePays($numCodePays)
    {
        $this->numCodePays = $numCodePays;

        return $this;
    }

    /**
     * Get numCodePays
     *
     * @return string
     */
    public function getNumCodePays()
    {
        return $this->numCodePays;
    }

    /**
     * Set phoneCodePays
     *
     * @param string $phoneCodePays
     *
     * @return Pays
     */
    public function setPhoneCodePays($phoneCodePays)
    {
        $this->phoneCodePays = $phoneCodePays;

        return $this;
    }

    /**
     * Get phoneCodePays
     *
     * @return string
     */
    public function getPhoneCodePays()
    {
        return $this->phoneCodePays;
    }
}
