<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pack
 *
 * @ORM\Table(name="pack")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\PackRepository")
 */
class Pack
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
     * @ORM\Column(name="nom", type="string", length=45)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string",
     *     message="La saisie n'est pas correcte."
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 45000,
     *      minMessage = "Le nom saisi est court.",
     *      maxMessage = "Le nom saisi est long."
     * )
     * @ORM\Column(name="description", type="string", length=45)
     */
    private $description;

    /**
     * @var int
     * @Assert\Type(
     *     type="integer",
     *     message="Le prix saisie n'est pas correcte."
     * )
     * @Assert\GreaterThanOrEqual(0)
     * @ORM\Column(name="prix", type="integer", nullable = true)
     */
    private $prix;

    /**
     * @ORM\OneToOne(targetEntity="Media", inversedBy="pack", cascade={"persist"})
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Pack
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
     * Set description
     *
     * @param string $description
     *
     * @return Pack
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Pack
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     *
     * @return Pack
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
}
