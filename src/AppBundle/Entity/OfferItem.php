<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfferItem
 *
 * @ORM\Table(name="brickskeeper_offer_item", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferItemRepository")
 */
class OfferItem
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Offer", inversedBy="offer_items", cascade={"persist"})
     * @ORM\JoinColumn(unique=false, nullable=false)
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Minifigure", inversedBy="offer_items", cascade={"persist"})
     * @ORM\JoinColumn(unique=false)
     */
    private $minifigure;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Set", inversedBy="offer_items", cascade={"persist"})
     * @ORM\JoinColumn(unique=false)
     */
    private $set;

    /**
     * @var int
     *
     * @ORM\Column(name="item_count", type="integer")
     */
    private $item_count;

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
     * Set offer
     *
     * @param Offer $offer
     *
     * @return OfferItem
     */
    public function setOffer(Offer $offer)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return Offer
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set minifigure
     *
     * @param Minifigure $minifigure
     *
     * @return OfferItem
     */
    public function setMinifigure(Minifigure $minifigure = null)
    {
        $this->minifigure = $minifigure;

        return $this;
    }

    /**
     * Get minifigure
     *
     * @return Minifigure
     */
    public function getMinifigure()
    {
        return $this->minifigure;
    }

    /**
     * Set set
     *
     * @param Set $set
     *
     * @return OfferItem
     */
    public function setSet(Set $set = null)
    {
        $this->set = $set;

        return $this;
    }

    /**
     * Get set
     *
     * @return Set
     */
    public function getSet()
    {
        return $this->set;
    }

    /**
     * Set item_count
     *
     * @param int $item_count
     *
     * @return OfferItem
     */
    public function setItemCount($item_count)
    {
        $this->item_count = $item_count;

        return $this;
    }

    /**
     * Get item_count
     *
     * @return int
     */
    public function getItemCount()
    {
        return $this->item_count;
    }

}
