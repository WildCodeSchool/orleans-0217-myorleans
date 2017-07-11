<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

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
     * @var int
     *
     * @ORM\Column(name="nb_chambre", type="integer", nullable=true)
     */
    private $nbChambre;

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
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=10, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="TypeLogement", inversedBy="flats")
     */
    private $typeLogement;

    /**
     * @ORM\ManyToOne(targetEntity="Residence", inversedBy="flats", cascade={"persist"})
     */
    private $residence;

    /**
     * @ORM\ManyToMany(targetEntity="Media", cascade={"persist"})
     * @JoinTable(name="flat_media")
     */
    private $medias;


    /**
     * @ORM\OneToMany(targetEntity="CategoriePresta", mappedBy="flat")
     */
    private $categoriePrestas;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;


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
     * @return int
     */
    public function getNbChambre()
    {
        return $this->nbChambre;
    }

    /**
     * @param int $nbChambre
     */
    public function setNbChambre($nbChambre)
    {
        $this->nbChambre = $nbChambre;
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
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medias = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTypeLogement()
    {
        return $this->typeLogement;
    }

    /**
     * @param mixed $typeLogement
     */
    public function setTypeLogement($typeLogement)
    {
        $this->typeLogement = $typeLogement;
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
    public function getCategoriePrestas()
    {
        return $this->categoriePrestas;
    }

    /**
     * @param mixed $categoriePrestas
     */
    public function setCategoriePrestas($categoriePrestas)
    {
        $this->categoriePrestas = $categoriePrestas;
    }



    /**
     * Add media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     *
     * @return Flat
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
     * Add categoriePresta
     *
     * @param \MyOrleansBundle\Entity\CategoriePresta $categoriePresta
     *
     * @return Flat
     */
    public function addCategoriePresta(\MyOrleansBundle\Entity\CategoriePresta $categoriePresta)
    {
        $this->categoriePrestas[] = $categoriePresta;

        return $this;
    }

    /**
     * Remove categoriePresta
     *
     * @param \MyOrleansBundle\Entity\CategoriePresta $categoriePresta
     */
    public function removeCategoriePresta(\MyOrleansBundle\Entity\CategoriePresta $categoriePresta)
    {
        $this->categoriePrestas->removeElement($categoriePresta);
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Flat
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
