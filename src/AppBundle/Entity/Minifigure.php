<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Minifigure
 *
 * @ORM\Table(name="brickskeeper_minifigure", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinifigureRepository")
 */
class Minifigure
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
     * @var \Datetime
     *
     * @ORM\Column(name="release_year", type="datetime")
     */
    private $release_year;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Serie", inversedBy="minifigures", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OfferItem", mappedBy="minifigure")
     */
    private $offer_items;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CollectionItem", mappedBy="minifigure")
     */
    private $collection_items;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MinifigureSet", mappedBy="minifigure")
     */
    private $minifigure_sets;

    public function __construct()
    {
        $this->offer_items = new ArrayCollection();
        $this->collection_items = new ArrayCollection();
        $this->minifigure_sets = new ArrayCollection();
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
     * @return Minifigure
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
     * @return Minifigure
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
     * @return Minifigure
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
     * Set releaseYear
     *
     * @param \DateTime $releaseYear
     *
     * @return Minifigure
     */
    public function setReleaseYear($releaseYear)
    {
        $this->release_year = $releaseYear;

        return $this;
    }

    /**
     * Get releaseYear
     *
     * @return \DateTime
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * Get serie
     *
     * @return Serie
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set serie
     *
     * @param Set $serie
     *
     * @return Minifigure
     */
    public function setSerie(Serie $serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Add offer item
     *
     * @param OfferItem $offer_item
     *
     * @return Offer
     */
    public function addOfferItem(OfferItem $offer_item)
    {
        $this->offer_items[] = $offer_item;

        return $this;
    }

    /**
     * Remove offer item
     *
     * @param OfferItem $offer_item
     *
     * @return Offer
     */
    public function removeOfferItem(OfferItem $offer_item)
    {
        $this->offer_items->removeElement($offer_item);

        return $this;
    }

    /**
     * Get offer items
     *
     * @return ArrayCollection
     */
    public function getOfferItems()
    {
        return $this->offer_items;
    }

    /**
     * Add collection item
     *
     * @param CollectionItem $collection_item
     *
     * @return Minifigure
     */
    public function addCollectionItem(CollectionItem $collection_item)
    {
        $this->collection_items[] = $collection_item;

        return $this;
    }

    /**
     * Remove collection item
     *
     * @param CollectionItem $collection_item
     *
     * @return Minifigure
     */
    public function removeCollectionItem(CollectionItem $collection_item)
    {
        $this->collection_items->removeElement($collection_item);

        return $this;
    }

    /**
     * Get collection items
     *
     * @return ArrayCollection
     */
    public function getCollectionItems()
    {
        return $this->collection_items;
    }

    /**
     * Add minifigure sets
     *
     * @param MinifigureSet $minifigure_sets
     *
     * @return Minifigure
     */
    public function addMinifigureSets(MinifigureSet $minifigure_sets)
    {
        $this->minifigure_sets[] = $minifigure_sets;

        return $this;
    }

    /**
     * Remove minifigure sets
     *
     * @param MinifigureSet $minifigure_sets
     *
     * @return Minifigure
     */
    public function removeMinifigureSets(MinifigureSet $minifigure_sets)
    {
        $this->minifigure_sets->removeElement($minifigure_sets);

        return $this;
    }

    /**
     * Get minifigure sets
     *
     * @return ArrayCollection
     */
    public function getMinifigureSets()
    {
        return $this->minifigure_sets;
    }
    
}
