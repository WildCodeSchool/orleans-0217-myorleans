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
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="categorie_prestas")
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
     * Set media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     *
     * @return CategoriePresta
     */
    public function setMedia(\MyOrleansBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \MyOrleansBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Add typePresta
     *
     * @param \MyOrleansBundle\Entity\TypePresta $typePresta
     *
     * @return CategoriePresta
     */
    public function addTypePresta(\MyOrleansBundle\Entity\TypePresta $typePresta)
    {
        $this->type_prestas[] = $typePresta;

        return $this;
    }

    /**
     * Remove typePresta
     *
     * @param \MyOrleansBundle\Entity\TypePresta $typePresta
     */
    public function removeTypePresta(\MyOrleansBundle\Entity\TypePresta $typePresta)
    {
        $this->type_prestas->removeElement($typePresta);
    }

    /**
     * Get typePrestas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypePrestas()
    {
        return $this->type_prestas;
    }
}
