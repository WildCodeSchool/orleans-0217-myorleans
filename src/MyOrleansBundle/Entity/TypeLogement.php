<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLogement
 *
 * @ORM\Table(name="type_logement")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\TypeLogementRepository")
 */
class TypeLogement
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
     * @ORM\Column(name="nom", type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="Flat", mappedBy="typeLogement")
     */
    private $flats;


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
     * @return TypeLogement
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
     * Constructor
     */
    public function __construct()
    {
        $this->flats = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     *
     * @return TypeLogement
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
}
