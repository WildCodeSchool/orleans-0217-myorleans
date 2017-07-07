<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestation
 *
 * @ORM\Table(name="prestation")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\PrestationRepository")
 */
class Prestation
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
     * @ORM\Column(name="nom_prestation", type="string", length=255, nullable=true)
     */
    private $nomPrestation;

    /**
     * @ORM\ManyToOne(targetEntity="TypePresta", inversedBy="prestations")
     */
    private $type_prestation;




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
    public function getNomPrestation()
    {
        return $this->nomPrestation;
    }

    /**
     * @param float $nomPrestation
     */
    public function setNomPrestation($nomPrestation)
    {
        $this->nomPrestation = $nomPrestation;
    }

    /**
     * @return mixed
     */
    public function getTypePrestation()
    {
        return $this->type_prestation;
    }

    /**
     * @param mixed $type_prestation
     */
    public function setTypePrestation($type_prestation)
    {
        $this->type_prestation = $type_prestation;
    }


}
