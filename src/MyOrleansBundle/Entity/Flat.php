<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string",
     *     message="La référence saisie n'est pas correcte."
     * )
     * @ORM\Column(name="reference", type="string", length=45)
     */
    private $reference;

    /**
     * @var int
     * @Assert\Type(
     *     type="integer",
     *     message="Le prix saisi n'est pas correcte."
     * )
     * @ORM\Column(name="prix", type="integer", nullable=true)
     */
    private $prix;

    /**
     * @var float
     * @Assert\Type(
     *     type="float",
     *     message="La surface saisie n'est pas correcte."
     * )
     * @ORM\Column(name="surface", type="float", nullable=true)
     */
    private $surface;

    /**
     * @var float
     *
     * @ORM\Column(name="surface_sejour", type="float", nullable=true)
     */
    private $surfaceSejour;

    /**
     * @var string
     *
     * @ORM\Column(name="exposition_sejour", type="text", nullable=true)
     */
    private $expositionSejour;

    /**
     * @var string
     *
     * @ORM\Column(name="stationnement", type="text", nullable=true)
     */
    private $stationnement;

    /**
     * @var int
     * @Assert\Type(
     *     type="integer",
     *     message="Le nombre de pièce saisi n'est pas correcte."
     * )
     * @ORM\Column(name="nb_piece", type="integer", nullable=true)
     */
    private $nbPiece;

    /**
     * @var int
     *  @Assert\Type(
     *     type="integer",
     *     message="Le nombre de chambre saisi n'est pas correcte."
     * )
     * @ORM\Column(name="nb_chambre", type="integer", nullable=true)
     */
    private $nbChambre;

    /**
     * @var string
     * @Assert\NotBlank()
     *  @Assert\Type(
     *     type="string",
     *     message="La saisie n'est pas correcte."
     * )
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prestation_complementaire", type="text", nullable=true)
     */
    private $prestationComplementaire;

    /**
     * @var bool
     *
     * @ORM\Column(name="statut", type="boolean", length=10, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="TypeBien", inversedBy="flats")
     */
    private $typeBien;

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
     * @return bool
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @param bool $statut
     */
    public function setStatut(bool $statut)
    {
        $this->statut = $statut;
    }


    /**
     * @return mixed
     */
    public function getTypeBien()
    {
        return $this->typeBien;
    }

    /**
     * @param mixed $typeBien
     */
    public function setTypeBien($typeBien)
    {
        $this->typeBien = $typeBien;
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
     * Set surfaceSejour
     *
     * @param float $surfaceSejour
     *
     * @return Flat
     */
    public function setSurfaceSejour($surfaceSejour)
    {
        $this->surfaceSejour = $surfaceSejour;

        return $this;
    }

    /**
     * Get surfaceSejour
     *
     * @return float
     */
    public function getSurfaceSejour()
    {
        return $this->surfaceSejour;
    }

    /**
     * Set expositionSejour
     *
     * @param string $expositionSejour
     *
     * @return Flat
     */
    public function setExpositionSejour($expositionSejour)
    {
        $this->expositionSejour = $expositionSejour;

        return $this;
    }

    /**
     * Get expositionSejour
     *
     * @return string
     */
    public function getExpositionSejour()
    {
        return $this->expositionSejour;
    }

    /**
     * Set stationnement
     *
     * @param string $stationnement
     *
     * @return Flat
     */
    public function setStationnement($stationnement)
    {
        $this->stationnement = $stationnement;

        return $this;
    }

    /**
     * Get stationnement
     *
     * @return string
     */
    public function getStationnement()
    {
        return $this->stationnement;
    }
}
