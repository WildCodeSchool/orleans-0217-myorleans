<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ville
 *
 * @ORM\Table(name="ville")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\VilleRepository")
 */
class Ville
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
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string",
     *     message="La saisie n'est pas correcte."
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 45,
     *      minMessage = "Le nom saisi est court.",
     *      maxMessage = "Le nom saisi est long."
     * )
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="Residence", mappedBy="ville", cascade={"all"}, fetch="EAGER")
     */
    private $residences;


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
     * @return Ville
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

    // getter setter $residences
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->residences = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Ville
     */
    public function addResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residences[] = $residence;

        return $this;
    }

    /**
     * Remove residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     */
    public function removeResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residences->removeElement($residence);
    }

    /**
     * Get residences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResidences()
    {
        return $this->residences;
    }
}
