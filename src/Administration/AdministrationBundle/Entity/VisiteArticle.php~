<?php

namespace Administration\AdministrationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisiteArticle
 *
 * @ORM\Table(name="visite_article")
 * @ORM\Entity(repositoryClass="Administration\AdministrationBundle\Repository\VisiteArticleRepository")
 */
class VisiteArticle
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
     * @ORM\ManyToOne(targetEntity="Administration\AdministrationBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $article;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_visiteArticle", type="datetime")
     */
    private $dateVisiteArticle;


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
     * Set dateVisiteArticle
     *
     * @param \DateTime $dateVisiteArticle
     *
     * @return VisiteArticle
     */
    public function setDateVisiteArticle($dateVisiteArticle)
    {
        $this->dateVisiteArticle = $dateVisiteArticle;

        return $this;
    }

    /**
     * Get dateVisiteArticle
     *
     * @return \DateTime
     */
    public function getDateVisiteArticle()
    {
        return $this->dateVisiteArticle;
    }

    /**
     * Set article
     *
     * @param \Administration\AdministrationBundle\Entity\Article $article
     *
     * @return VisiteArticle
     */
    public function setArticle(\Administration\AdministrationBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Administration\AdministrationBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
