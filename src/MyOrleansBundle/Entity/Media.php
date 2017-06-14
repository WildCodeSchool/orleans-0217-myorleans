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
    private $flats;

    /**
     * @ORM\ManyToMany(targetEntity="Residence")
     */
    private $residences;

    /**
     * @ORM\ManyToOne(targetEntity="Evenement", inversedBy="medias")
     */
    private $evenement;


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
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="media")
     */
    private $articles;

    /**
     * @ORM\ManyToOne(targetEntity="TypeMedia", inversedBy="medias")
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
        $this->residences = new \Doctrine\Common\Collections\ArrayCollection();
        $this->flats = new \Doctrine\Common\Collections\ArrayCollection();
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


}
