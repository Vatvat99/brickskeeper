<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Set
 *
 * @ORM\Table(name="brickskeeper_set", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SetRepository")
 */
class Set
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
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

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
     * @var string
     *
     * @ORM\Column(name="release_year", type="string", length=4)
     */
    private $release_year;

    /**
     * @var float
     * 
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Serie", inversedBy="sets", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OfferItem", mappedBy="set")
     */
    private $offer_items;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CollectionItem", mappedBy="set")
     */
    private $collection_items;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MinifigureSet", mappedBy="set")
     */
    private $set_minifigures;

    public function __construct()
    {
        $this->offer_items = new ArrayCollection();
        $this->collection_items = new ArrayCollection();
        $this->set_minifigures = new ArrayCollection();
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
     * Set number
     *
     * @param int $number
     *
     * @return Set
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Set
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
     * @return Set
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
     * @return Set
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
     * Set release_year
     *
     * @param string $release_year
     *
     * @return Set
     */
    public function setReleaseYear($release_year)
    {
        $this->release_year = $release_year;

        return $this;
    }

    /**
     * Get release_year
     *
     * @return string
     */
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Set
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set serie
     *
     * @param Serie $serie
     *
     * @return Set
     */
    public function setSerie(Serie $serie)
    {
        $this->serie = $serie;

        return $this;
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
     * Add set minifigures
     *
     * @param MinifigureSet $set_minifigures
     *
     * @return Set
     */
    public function addSetMinifigures(MinifigureSet $set_minifigures)
    {
        $this->set_minifigures[] = $set_minifigures;

        return $this;
    }

    /**
     * Remove set minifigures
     *
     * @param MinifigureSet $set_minifigures
     *
     * @return Minifigure
     */
    public function removeSetMinifigures(MinifigureSet $set_minifigures)
    {
        $this->set_minifigures->removeElement($set_minifigures);

        return $this;
    }

    /**
     * Get set minifigures
     *
     * @return ArrayCollection
     */
    public function getSetMinifigures()
    {
        return $this->set_minifigures;
    }

}
