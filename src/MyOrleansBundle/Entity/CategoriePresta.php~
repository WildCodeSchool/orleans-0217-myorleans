<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriePresta
 *
 * @ORM\Table(name="categorie_presta")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\CategoriePrestaRepository")
 */
class CategoriePresta
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
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $nomCategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre_affichage", type="integer", nullable=true)
     */
    private $ordreAffichage;

    /**
     * @ORM\ManyToOne(targetEntity="Flat", inversedBy="categoriePrestas")
     */
    private $flat;

    /**
     * @ORM\ManyToOne(targetEntity="Residence", inversedBy="categoriePrestas")
     */
    private $residence;

    /**
     * @ORM\OneToOne(targetEntity="Media")
     */
    private $media;

    /**
     * @ORM\OneToMany(targetEntity="TypePresta", mappedBy="categorie_presta")
     */
    private $type_prestas;


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
     * Constructor
     */
    public function __construct()
    {
        $this->type_prestas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNomCategorie()
    {
        return $this->nomCategorie;
    }

    /**
     * @param mixed $nomCategorie
     */
    public function setNomCategorie($nomCategorie)
    {
        $this->nomCategorie = $nomCategorie;
    }

    /**
     * @return mixed
     */
    public function getOrdreAffichage()
    {
        return $this->ordreAffichage;
    }

    /**
     * @param mixed $ordreAffichage
     */
    public function setOrdreAffichage($ordreAffichage)
    {
        $this->ordreAffichage = $ordreAffichage;
    }

    /**
     * @return mixed
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * @param mixed $flat
     */
    public function setFlat($flat)
    {
        $this->flat = $flat;
    }

    /**
     * @return mixed
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * @param mixed $residence
     */
    public function setResidence($residence)
    {
        $this->residence = $residence;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @return mixed
     */
    public function getTypePrestas()
    {
        return $this->type_prestas;
    }

    /**
     * @param mixed $type_prestas
     */
    public function setTypePrestas($type_prestas)
    {
        $this->type_prestas = $type_prestas;
    }


}
