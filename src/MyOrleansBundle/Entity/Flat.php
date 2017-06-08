<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flat
 *
 * @ORM\Table(name="flat")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\FlatRepository")
 */
class Flat
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
     * @ORM\Column(name="reference", type="string", length=45, nullable=true)
     */
    private $reference;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var float
     *
     * @ORM\Column(name="surface", type="float", nullable=true)
     */
    private $surface;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_piece", type="integer", nullable=true)
     */
    private $nbPiece;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prestation_complementaire", type="text", nullable=true)
     */
    private $prestationComplementaire;

    /**
     * @ORM\ManyToOne(targetEntity="Residence", inversedBy="flats")
     */
    private $residence;

    /**
     * @ORM\ManyToMany(targetEntity="Media")
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity="Presta", mappedBy="flat")
     */
    private $prestas;

    /**
     * @var string
     *
     * @ORM\Column(name="statu", type="string", length=10, nullable=true)
     */
    private $statu;

    /**
     * @return string
     */
    public function getStatu()
    {
        return $this->statu;
    }

    /**
     * @param string $statu
     */
    public function setStatu($statu)
    {
        $this->statu = $statu;
    }



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
     * @return Flat
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
     * Set reference
     *
     * @param string $reference
     *
     * @return Flat
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Flat
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set surface
     *
     * @param float $surface
     *
     * @return Flat
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return float
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set nbPiece
     *
     * @param integer $nbPiece
     *
     * @return Flat
     */
    public function setNbPiece($nbPiece)
    {
        $this->nbPiece = $nbPiece;

        return $this;
    }

    /**
     * Get nbPiece
     *
     * @return int
     */
    public function getNbPiece()
    {
        return $this->nbPiece;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Flat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prestationComplementaire
     *
     * @param string $prestationComplementaire
     *
     * @return Flat
     */
    public function setPrestationComplementaire($prestationComplementaire)
    {
        $this->prestationComplementaire = $prestationComplementaire;

        return $this;
    }

    /**
     * Get prestationComplementaire
     *
     * @return string
     */
    public function getPrestationComplementaire()
    {
        return $this->prestationComplementaire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->media = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Flat
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
     * Add medium
     *
     * @param \MyOrleansBundle\Entity\Media $medium
     *
     * @return Flat
     */
    public function addMedia(\MyOrleansBundle\Entity\Media $medium)
    {
        $this->media[] = $medium;

        return $this;
    }

    /**
     * Remove medium
     *
     * @param \MyOrleansBundle\Entity\Media $medium
     */
    public function removeMedia(\MyOrleansBundle\Entity\Media $medium)
    {
        $this->media->removeElement($medium);
    }

    /**
     * Get media
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Add presta
     *
     * @param \MyOrleansBundle\Entity\Presta $presta
     *
     * @return Flat
     */
    public function addPresta(\MyOrleansBundle\Entity\Presta $presta)
    {
        $this->prestas[] = $presta;

        return $this;
    }

    /**
     * Remove presta
     *
     * @param \MyOrleansBundle\Entity\Presta $presta
     */
    public function removePresta(\MyOrleansBundle\Entity\Presta $presta)
    {
        $this->prestas->removeElement($presta);
    }

    /**
     * Get prestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrestas()
    {
        return $this->prestas;
    }
}
