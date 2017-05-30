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
     * @ORM\ManyToOne(targetEntity="Media", inversedBy="categorie_prestas")
     */
    private $media;


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
}
