<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Residence
 *
 * @ORM\Table(name="residence")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\ResidenceRepository")
 */
class Residence
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
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=45, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=45, nullable=true)
     */
    private $quartier;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_livraison", type="date", nullable=true)
     */
    private $dateLivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_total_logements", type="integer", nullable=true)
     */
    private $nbTotalLogements;

    /**
     * @var float
     *
     * @ORM\Column(name="note_transports", type="float", nullable=true)
     */
    private $noteTransports;

    /**
     * @var float
     *
     * @ORM\Column(name="note_commerces", type="float", nullable=true)
     */
    private $noteCommerces;

    /**
     * @var float
     *
     * @ORM\Column(name="note_services", type="float", nullable=true)
     */
    private $noteServices;

    /**
     * @var float
     *
     * @ORM\Column(name="note_esthetisme", type="float", nullable=true)
     */
    private $noteEsthetisme;

    /**
     * @var string
     *
     * @ORM\Column(name="citation", type="text", nullable=true)
     */
/*    private $citation;*/

    /**
     * @var string
     *
     * @ORM\Column(name="pinel", type="string", length=45, nullable=true)
     */
/*    private $pinel;*/



    /**
     * @var int
     *
     * @ORM\Column(name="favoris", type="integer", nullable=true)
     */
    private $favoris;

    /**
     * @ORM\ManyToMany(targetEntity="Media")
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity="Flat", mappedBy="residence")
     */
    private $flats;

    /**
     * @ORM\OneToMany(targetEntity="Presta", mappedBy="residence")
     */
    private $prestas;





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
     * Set nom
     *
     * @param string $nom
     *
     * @return Residence
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Residence
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Residence
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Residence
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * @param string $quartier
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Residence
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Residence
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     *
     * @return Residence
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Residence
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
     * Set nbTotalLogements
     *
     * @param integer $nbTotalLogements
     *
     * @return Residence
     */
    public function setNbTotalLogements($nbTotalLogements)
    {
        $this->nbTotalLogements = $nbTotalLogements;

        return $this;
    }

    /**
     * Get nbTotalLogements
     *
     * @return int
     */
    public function getNbTotalLogements()
    {
        return $this->nbTotalLogements;
    }

    /**
     * Set noteTransports
     *
     * @param float $noteTransports
     *
     * @return Residence
     */
    public function setNoteTransports($noteTransports)
    {
        $this->noteTransports = $noteTransports;

        return $this;
    }

    /**
     * Get noteTransports
     *
     * @return float
     */
    public function getNoteTransports()
    {
        return $this->noteTransports;
    }

    /**
     * Set noteCommerces
     *
     * @param float $noteCommerces
     *
     * @return Residence
     */
    public function setNoteCommerces($noteCommerces)
    {
        $this->noteCommerces = $noteCommerces;

        return $this;
    }

    /**
     * Get noteCommerces
     *
     * @return float
     */
    public function getNoteCommerces()
    {
        return $this->noteCommerces;
    }

    /**
     * Set noteServices
     *
     * @param float $noteServices
     *
     * @return Residence
     */
    public function setNoteServices($noteServices)
    {
        $this->noteServices = $noteServices;

        return $this;
    }

    /**
     * Get noteServices
     *
     * @return float
     */
    public function getNoteServices()
    {
        return $this->noteServices;
    }

    /**
     * Set noteEsthetisme
     *
     * @param float $noteEsthetisme
     *
     * @return Residence
     */
    public function setNoteEsthetisme($noteEsthetisme)
    {
        $this->noteEsthetisme = $noteEsthetisme;

        return $this;
    }

    /**
     * Get noteEsthetisme
     *
     * @return float
     */
    public function getNoteEsthetisme()
    {
        return $this->noteEsthetisme;
    }

    /**
     * Set favoris
     *
     * @param integer $favoris
     *
     * @return Residence
     */
    public function setFavoris($favoris)
    {
        $this->favoris = $favoris;

        return $this;
    }

    /**
     * Get favoris
     *
     * @return int
     */
    public function getFavoris()
    {
        return $this->favoris;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->media = new \Doctrine\Common\Collections\ArrayCollection();
        $this->appartements = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medium
     *
     * @param \MyOrleansBundle\Entity\Media $medium
     *
     * @return Residence
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
     * Add flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     *
     * @return Residence
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
     * Get flats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFlats()
    {
        return $this->flats;
    }

    /**
     * Add presta
     *
     * @param \MyOrleansBundle\Entity\Presta $presta
     *
     * @return Residence
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

    /**
     * Set citation
     *
     * @param string $citation
     *
     * @return Residence
     */
/*    public function setCitation($citation)
    {
        $this->citation = $citation;

        return $this;
    }*/

    /**
     * Get citation
     *
     * @return string
     */
/*    public function getCitation()
    {
        return $this->citation;
    }*/

    /**
     * Set pinel
     *
     * @param string $pinel
     *
     * @return Residence
     */
/*    public function setPinel($pinel)
    {
        $this->pinel = $pinel;

        return $this;
    }*/

    /**
     * Get pinel
     *
     * @return string
     */
/*    public function getPinel()
    {
        return $this->pinel;
    }*/
}
