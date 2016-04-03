<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="brickskeeper_serie", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SerieRepository")
 */
class Serie
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @var Range
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Range", inversedBy="series", cascade={"persist"})
     */
    private $range;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Minifigure", mappedBy="serie", cascade={"persist", "remove"})
     */
    private $minifigures;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Set", mappedBy="serie", cascade={"persist", "remove"})
     */
    private $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
        $this->minifigures = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Serie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Serie
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Serie
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return Serie
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set range
     *
     * @param Range $range
     *
     * @return Serie
     */
    public function setRange(Range $range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * Get range
     *
     * @return Range
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * Add minifigure
     *
     * @param Minifigure $minifigure
     *
     * @return Serie
     */
    public function addMinifigure(Minifigure $minifigure)
    {
        $this->minifigures[] = $minifigure;

        return $this;
    }

    /**
     * Remove minifigure
     *
     * @param Minifigure $minifigure
     * 
     * @return Serie
     */
    public function removeMinifigure(Minifigure $minifigure)
    {
        $this->minifigures->removeElement($minifigure);

        return $this;
    }

    /**
     * Get minifigures
     *
     * @return ArrayCollection
     */
    public function getMinifigures()
    {
        return $this->minifigures;
    }

    /**
     * Add set
     *
     * @param Set $set
     *
     * @return Serie
     */
    public function addSet(Set $set)
    {
        $this->sets[] = $set;

        return $this;
    }

    /**
     * Remove set
     *
     * @param Set $set
     * 
     * @return Serie
     */
    public function removeSet(Set $set)
    {
        $this->sets->removeElement($set);
        
        return $this;
    }

    /**
     * Get sets
     *
     * @return ArrayCollection
     */
    public function getSets()
    {
        return $this->sets;
    }

}
