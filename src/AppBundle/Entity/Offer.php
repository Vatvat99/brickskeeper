<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="brickskeeper_offer", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 */
class Offer
{

    /**
     * Nombre d'offres affichées sur une page
     */
    const NUM_ITEMS = 32;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text") @todo check si le type mysql est bien text
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="simple_array")
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="submitted_at", type="datetime")
     */
    private $submitted_at;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OfferItem", mappedBy="offer", cascade={"persist", "remove"})
     */
    private $offer_items;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OfferPicture", mappedBy="offer", cascade={"persist", "remove"})
     */
    private $offer_pictures;

    public function __construct()
    {
        $this->offer_items = new ArrayCollection();
        $this->offer_pictures = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Offer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Offer
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
     * Set type
     *
     * @param string $type
     *
     * @return Offer
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
     * Set price
     *
     * @param float
     *
     * @return Offer
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
     * Set active
     *
     * @param boolean
     *
     * @return Offer
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set submitted_at
     *
     * @param \Datetime
     *
     * @return Offer
     */
    public function setSubmittedAt($submitted_at)
    {
        $this->submitted_at = $submitted_at;

        return $this;
    }

    /**
     * Get submitted_at
     *
     * @return \Datetime
     */
    public function getSubmittedAt()
    {
        return $this->submitted_at;
    }
    
    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->getUser()->getFirstname() . ' ' . $this->getUser()->getLastname();
    }

    /**
     * Set user
     *
     * @param User
     *
     * @return Offer
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
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
     * Add offer picture
     *
     * @param OfferPicture $offer_picture
     *
     * @return Offer
     */
    public function addOfferPicture(OfferPicture $offer_picture)
    {
        $this->offer_pictures[] = $offer_picture;

        return $this;
    }

    /**
     * Remove offer picture
     *
     * @param OfferPicture $offer_picture
     *
     * @return Offer
     */
    public function removeOfferPicture(OfferPicture $offer_picture)
    {
        $this->offer_pictures->removeElement($offer_picture);

        return $this;
    }

    /**
     * Get offer pictures
     *
     * @return ArrayCollection
     */
    public function getOfferPictures()
    {
        return $this->offer_pictures;
    }

    /**
     * Génère le nombre de jour restant avant la suppression de l'annonce
     */
    public function getRemainingDays() {

        $todayTimestamp = time();
        $submittedAt = $this->submitted_at;
        $publicationTimestamp = strtotime($submittedAt->format('Y-m-d H:i:s'));
        $removalTimestamp = $publicationTimestamp + (2*31*24*60*60);
        $remainingDays = round(($removalTimestamp - $todayTimestamp) / (60*60*24));

        return $remainingDays;

    }

}
