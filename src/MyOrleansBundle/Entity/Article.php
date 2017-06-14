<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=45)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Media", mappedBy="articles", cascade={"all"}, fetch="EAGER")
     */
    private $medias;


    /**
     * @ORM\ManyToOne(targetEntity="Residence")
     */
    private $residence;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="articles", cascade={"all"}, fetch="EAGER")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="TypeArticle", mappedBy="articles")
     */
    private $typeArticle;



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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Article
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Article
     */
    public function setResidence(\MyOrleansBundle\Entity\Residence $residence = null)
    {
        $this->residence = $residence;

        return $this;
    }

    /**
     * Get residence
     *
     * @return \MyOrleansBundle\Entity\Residence
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @return mixed
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * @param mixed $medias
     */
    public function setMedias($medias)
    {
        $this->medias = $medias;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTypeArticle()
    {
        return $this->typeArticle;
    }

    /**
     * @param mixed $typeArticle
     */
    public function setTypeArticle($typeArticle)
    {
        $this->typeArticle = $typeArticle;
    }

}
