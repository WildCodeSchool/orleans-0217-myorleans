<?php

namespace MyOrleansBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="MyOrleansBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\Column(name="page", type="string", length=45, nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=45, nullable=true)
     */
    private $lien;

    /**
     * @ORM\ManyToMany(targetEntity="Appartement")
     */
    private $appartement;

    /**
     * @ORM\ManyToMany(targetEntity="Residence")
     */
    private $residence;

    /**
     * @ORM\ManyToOne(targetEntity="Evenement", inversedBy="medias")
     */
    private $evenement;


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
     * @return Media
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
     * Set page
     *
     * @param string $page
     *
     * @return Media
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Media
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appartement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->residence = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add appartement
     *
     * @param \MyOrleansBundle\Entity\Appartement $appartement
     *
     * @return Media
     */
    public function addAppartement(\MyOrleansBundle\Entity\Appartement $appartement)
    {
        $this->appartement[] = $appartement;

        return $this;
    }

    /**
     * Remove appartement
     *
     * @param \MyOrleansBundle\Entity\Appartement $appartement
     */
    public function removeAppartement(\MyOrleansBundle\Entity\Appartement $appartement)
    {
        $this->appartement->removeElement($appartement);
    }

    /**
     * Get appartement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppartement()
    {
        return $this->appartement;
    }

    /**
     * Add residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     *
     * @return Media
     */
    public function addResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residence[] = $residence;

        return $this;
    }

    /**
     * Remove residence
     *
     * @param \MyOrleansBundle\Entity\Residence $residence
     */
    public function removeResidence(\MyOrleansBundle\Entity\Residence $residence)
    {
        $this->residence->removeElement($residence);
    }

    /**
     * Get residence
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getResidence()
    {
        return $this->residence;
    }

    /**
     * Set evenement
     *
     * @param \MyOrleansBundle\Entity\Evenement $evenement
     *
     * @return Media
     */
    public function setEvenement(\MyOrleansBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \MyOrleansBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }
}
