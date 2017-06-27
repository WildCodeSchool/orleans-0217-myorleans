<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\Annotation\Enum;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\ArticleRepository")
 */
class Article
{

    CONST NUM_ARTICLES = 9;

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
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="Media", cascade={"all"}, fetch="EAGER")
     */
    private $medias;


    /**
     * @ORM\ManyToOne(targetEntity="Residence")
     * @JoinTable(name="article_media")
     */
    private $residence;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="articles", cascade={"all"}, fetch="EAGER")
     */
    private $tags;

    /**
     * @ORM\ManyToOne(targetEntity="TypeArticle", inversedBy="articles")
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
     * Set texte
     *
     * @param string $texte
     *
     * @return Article
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
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


    /**
     * Add media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     *
     * @return Article
     */
    public function addMedia(\MyOrleansBundle\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     */
    public function removeMedia(\MyOrleansBundle\Entity\Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Add tag
     *
     * @param \MyOrleansBundle\Entity\Tag $tag
     *
     * @return Article
     */
    public function addTag(\MyOrleansBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \MyOrleansBundle\Entity\Tag $tag
     */
    public function removeTag(\MyOrleansBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }
}
