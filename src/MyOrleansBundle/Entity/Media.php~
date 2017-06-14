<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="page", type="string", length=45, nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=45, nullable=true)
     */
    private $lien;

    /**
     * @ORM\ManyToMany(targetEntity="Flat")
     */
    private $flat;

    /**
     * @ORM\ManyToMany(targetEntity="Residence")
     */
    private $residence;

    /**
     * @ORM\OneToOne(targetEntity="Evenement", mappedBy="media")
     */
    private $evenement;

    /**
     * @ORM\OneToMany(targetEntity="CategoriePresta", mappedBy="media")
     */
    private $categorie_prestas;


    /**
     * @ORM\OneToOne(targetEntity="Partenaire", mappedBy="media")
     */
    private $partenaire;


    /**
     * @ORM\OneToOne(targetEntity="Service", mappedBy="media")
     */
    private $service;


    /**
     * @ORM\OneToOne(targetEntity="Pack", mappedBy="media")
     */
    private $pack;

    /**
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="medias")
     */
    private $article;

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
     * Set type
     *
     * @param string $type
     *
     * @return Media
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set page
     *
     * @param string $page
     *
     * @return Media
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Media
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->residence = new \Doctrine\Common\Collections\ArrayCollection();
        $this->flat = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Media
     */
    public function addResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residence[] = $residence;

        return $this;
    }

    /**
     * Remove residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     */
    public function removeResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residence->removeElement($residence);
    }

    /**
     * Get residence
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * Set evenement
     *
     * @param \MyOrleansBundle\Entity\Evenement $evenement
     *
     * @return Media
     */
    public function setEvenement(\MyOrleansBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \MyOrleansBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Add flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     *
     * @return Media
     */
    public function addFlat(\MyOrleansBundle\Entity\Flat $flat)
    {
        $this->flat[] = $flat;

        return $this;
    }

    /**
     * Remove flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     */
    public function removeFlat(\MyOrleansBundle\Entity\Flat $flat)
    {
        $this->flat->removeElement($flat);
    }

    /**
     * Get flat
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Add categoriePresta
     *
     * @param \MyOrleansBundle\Entity\CategoriePresta $categoriePresta
     *
     * @return Media
     */
    public function addCategoriePresta(\MyOrleansBundle\Entity\CategoriePresta $categoriePresta)
    {
        $this->categorie_prestas[] = $categoriePresta;

        return $this;
    }

    /**
     * Remove categoriePresta
     *
     * @param \MyOrleansBundle\Entity\CategoriePresta $categoriePresta
     */
    public function removeCategoriePresta(\MyOrleansBundle\Entity\CategoriePresta $categoriePresta)
    {
        $this->categorie_prestas->removeElement($categoriePresta);
    }

    /**
     * Get categoriePrestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoriePrestas()
    {
        return $this->categorie_prestas;
    }

    /**
     * Set partenaire
     *
     * @param \MyOrleansBundle\Entity\Partenaire $partenaire
     *
     * @return Media
     */
    public function setPartenaire(\MyOrleansBundle\Entity\Partenaire $partenaire = null)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return \MyOrleansBundle\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Set service
     *
     * @param \MyOrleansBundle\Entity\Service $service
     *
     * @return Media
     */
    public function setService(\MyOrleansBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \MyOrleansBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set pack
     *
     * @param \MyOrleansBundle\Entity\Pack $pack
     *
     * @return Media
     */
    public function setPack(\MyOrleansBundle\Entity\Pack $pack = null)
    {
        $this->pack = $pack;

        return $this;
    }

    /**
     * Get pack
     *
     * @return \MyOrleansBundle\Entity\Pack
     */
    public function getPack()
    {
        return $this->pack;
    }

    /**
     * Add article
     *
     * @param \MyOrleansBundle\Entity\Article $article
     *
     * @return Media
     */
    public function addArticle(\MyOrleansBundle\Entity\Article $article)
    {
        $this->article[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \MyOrleansBundle\Entity\Article $article
     */
    public function removeArticle(\MyOrleansBundle\Entity\Article $article)
    {
        $this->article->removeElement($article);
    }

    /**
     * Get article
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticle()
    {
        return $this->article;
    }
}
