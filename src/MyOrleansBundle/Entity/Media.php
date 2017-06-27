<?php

namespace MyOrleansBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @ORM\Column(name="page", type="string", length=45, nullable=true)
     */
    private $page;

    /**
     * @var string
     * @Assert\File()
     * @ORM\Column(name="lien", type="text", nullable=true)
     */
    private $lien;

    /**
     * @ORM\ManyToMany(targetEntity="Flat", cascade={"persist"})
     */
    private $flats;

    /**
     * @ORM\ManyToMany(targetEntity="Residence", cascade={"persist"})
     */
    private $residences;

    /**
     * @ORM\OneToOne(targetEntity="Evenement", mappedBy="media")
     */
    private $evenement;


    /**
     * @ORM\OneToOne(targetEntity="Partenaire", mappedBy="media", cascade={"persist"})
     */
    private $partenaire;


    /**
     * @ORM\OneToOne(targetEntity="Service", mappedBy="media")
     */
    private $service;

    /**
     * @ORM\OneToOne(targetEntity="Collaborateur", mappedBy="media")
     */
    private $collaborateur;

    /**
     * @ORM\OneToOne(targetEntity="Pack", mappedBy="media")
     */
    private $pack;

    /**
     * @ORM\ManyToMany(targetEntity="Article",cascade={"persist"})
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="TypeMedia", inversedBy="medias", cascade={"persist"})
     */
    private $typeMedia;

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
        $this->residences = new ArrayCollection();
        $this->flats = new ArrayCollection();
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
     * @return mixed
     */
    public function getFlats()
    {
        return $this->flats;
    }

    /**
     * @param mixed $flats
     */
    public function setFlats($flats)
    {
        $this->flats = $flats;
    }

    /**
     * @return mixed
     */
    public function getResidences()
    {
        return $this->residences;
    }

    /**
     * @param mixed $residences
     */
    public function setResidences($residences)
    {
        $this->residences = $residences;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    /**
     * @return mixed
     */
    public function getTypeMedia()
    {
        return $this->typeMedia;
    }

    /**
     * @param mixed $typeMedia
     */
    public function setTypeMedia($typeMedia)
    {
        $this->typeMedia = $typeMedia;
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
        $this->flats[] = $flat;

        return $this;
    }

    /**
     * Remove flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     */
    public function removeFlat(\MyOrleansBundle\Entity\Flat $flat)
    {
        $this->flats->removeElement($flat);
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
        $this->residences[] = $residence;

        return $this;
    }

    /**
     * Remove residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     */
    public function removeResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residences->removeElement($residence);
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
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \MyOrleansBundle\Entity\Article $article
     */
    public function removeArticle(\MyOrleansBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * @return mixed
     */
    public function getCollaborateur()
    {
        return $this->collaborateur;
    }

    /**
     * @param mixed $collaborateur
     */
    public function setCollaborateur($collaborateur)
    {
        $this->collaborateur = $collaborateur;
    }


}
