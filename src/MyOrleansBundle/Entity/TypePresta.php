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
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $nomType;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriePresta", inversedBy="type_prestas")
     */
    private $categorie_presta;

    /**
     * @ORM\OneToMany(targetEntity="Prestation", mappedBy="type_prestation")
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
     * @return string
     */
    public function getNomType()
    {
        return $this->nomType;
    }

    /**
     * @param string $nomType
     */
    public function setNomType($nomType)
    {
        $this->nomType = $nomType;
    }

    /**
     * @return mixed
     */
    public function getCategoriePresta()
    {
        return $this->categorie_presta;
    }

    /**
     * @param mixed $categorie_presta
     */
    public function setCategoriePresta($categorie_presta)
    {
        $this->categorie_presta = $categorie_presta;
    }

    /**
     * @return mixed
     */
    public function getPrestas()
    {
        return $this->prestas;
    }

    /**
     * @param mixed $prestas
     */
    public function setPrestas($prestas)
    {
        $this->prestas = $prestas;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prestas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prestation
     *
     * @param \MyOrleansBundle\Entity\Prestation $presta
     *
     * @return TypePresta
     */
    public function addPresta(\MyOrleansBundle\Entity\Prestation $presta)
    {
        $this->prestas[] = $presta;

        return $this;
    }

    /**
     * Remove prestation
     *
     * @param \MyOrleansBundle\Entity\Prestayio $presta
     */
    public function removePresta(\MyOrleansBundle\Entity\Prestation $presta)
    {
        $this->prestas->removeElement($presta);
    }
}
