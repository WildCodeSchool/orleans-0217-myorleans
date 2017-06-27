<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Collaborateur
 *
 * @ORM\Table(name="collaborateur")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\CollaborateurRepository")
 */
class Collaborateur
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
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=true)
     */
    private $prenom;
    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=45, nullable=true)
     */
    private $fonction;
    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text", nullable=true)
     */
    private $bio;
    /**
     * @var string
     *
     * @ORM\Column(name="lien_twiter", type="string", length=45, nullable=true)
     */
    private $lienTwiter;
    /**
     * @var string
     *
     * @ORM\Column(name="lien_linkedin", type="string", length=45, nullable=true)
     */
    private $lienLinkedin;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;
    /**
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist"})
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
     * @return Collaborateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Collaborateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Collaborateur
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Collaborateur
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set lienTwiter
     *
     * @param string $lienTwiter
     *
     * @return Collaborateur
     */
    public function setLienTwiter($lienTwiter)
    {
        $this->lienTwiter = $lienTwiter;
        return $this;
    }

    /**
     * Get lienTwiter
     *
     * @return string
     */
    public function getLienTwiter()
    {
        return $this->lienTwiter;
    }

    /**
     * Set lienLinkedin
     *
     * @param string $lienLinkedin
     *
     * @return Collaborateur
     */
    public function setLienLinkedin($lienLinkedin)
    {
        $this->lienLinkedin = $lienLinkedin;
        return $this;
    }

    /**
     * Get lienLinkedin
     *
     * @return string
     */
    public function getLienLinkedin()
    {
        return $this->lienLinkedin;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Collaborateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set media
     *
     * @param \MyOrleansBundle\Entity\Media $media
     *
     * @return Collaborateur
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
