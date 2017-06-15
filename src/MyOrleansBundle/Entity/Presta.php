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
    private $nomPresta;

    /**
     * @ORM\ManyToOne(targetEntity="TypePresta", inversedBy="prestas")
     */
    private $type_presta;




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
     * @return float
     */
    public function getNomPresta()
    {
        return $this->nomPresta;
    }

    /**
     * @param float $nomPresta
     */
    public function setNomPresta($nomPresta)
    {
        $this->nomPresta = $nomPresta;
    }

    /**
     * @return mixed
     */
    public function getTypePresta()
    {
        return $this->type_presta;
    }

    /**
     * @param mixed $type_presta
     */
    public function setTypePresta($type_presta)
    {
        $this->type_presta = $type_presta;
    }


}
