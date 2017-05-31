<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypePresta
 *
 * @ORM\Table(name="type_presta")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\TypePrestaRepository")
 */
class TypePresta
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
     * @ORM\Column(name="ordre", type="string", length=255)
     */
    private $ordre;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre_affichage", type="integer", nullable=true)
     */
    private $ordreAffichage;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriePresta", inversedBy="type_prestas")
     */
    private $categorie_presta;

    /**
     * @ORM\OneToMany(targetEntity="Presta", mappedBy="type_presta")
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
     * Set type
     *
     * @param string $type
     *
     * @return TypePresta
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
     * Set ordre
     *
     * @param string $ordre
     *
     * @return TypePresta
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set ordreAffichage
     *
     * @param integer $ordreAffichage
     *
     * @return TypePresta
     */
    public function setOrdreAffichage($ordreAffichage)
    {
        $this->ordreAffichage = $ordreAffichage;

        return $this;
    }

    /**
     * Get ordreAffichage
     *
     * @return int
     */
    public function getOrdreAffichage()
    {
        return $this->ordreAffichage;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prestas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categoriePresta
     *
     * @param \MyOrleansBundle\Entity\CategoriePresta $categoriePresta
     *
     * @return TypePresta
     */
    public function setCategoriePresta(\MyOrleansBundle\Entity\CategoriePresta $categoriePresta = null)
    {
        $this->categorie_presta = $categoriePresta;

        return $this;
    }

    /**
     * Get categoriePresta
     *
     * @return \MyOrleansBundle\Entity\CategoriePresta
     */
    public function getCategoriePresta()
    {
        return $this->categorie_presta;
    }

    /**
     * Add presta
     *
     * @param \MyOrleansBundle\Entity\Presta $presta
     *
     * @return TypePresta
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
