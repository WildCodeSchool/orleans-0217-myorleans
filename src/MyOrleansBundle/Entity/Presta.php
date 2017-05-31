<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presta
 *
 * @ORM\Table(name="presta")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\PrestaRepository")
 */
class Presta
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
     * @var float
     *
     * @ORM\Column(name="value", type="float", nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="TypePresta", inversedBy="prestas")
     */
    private $type_presta;

    /**
     * @ORM\ManyToOne(targetEntity="Flat", inversedBy="prestas")
     */
    private $flat;

    /**
     * @ORM\ManyToOne(targetEntity="Residence", inversedBy="prestas")
     */
    private $residence;


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
     * Set value
     *
     * @param float $value
     *
     * @return Presta
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set typePresta
     *
     * @param \MyOrleansBundle\Entity\TypePresta $typePresta
     *
     * @return Presta
     */
    public function setTypePresta(\MyOrleansBundle\Entity\TypePresta $typePresta = null)
    {
        $this->type_presta = $typePresta;

        return $this;
    }

    /**
     * Get typePresta
     *
     * @return \MyOrleansBundle\Entity\TypePresta
     */
    public function getTypePresta()
    {
        return $this->type_presta;
    }

    /**
     * Set flat
     *
     * @param \MyOrleansBundle\Entity\Flat $flat
     *
     * @return Presta
     */
    public function setFlat(\MyOrleansBundle\Entity\Flat $flat = null)
    {
        $this->flat = $flat;

        return $this;
    }

    /**
     * Get flat
     *
     * @return \MyOrleansBundle\Entity\Flat
     */
    public function getFlat()
    {
        return $this->flat;
    }

    /**
     * Set residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Presta
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
}
