<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="brickskeeper_offer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OfferRepository")
 */
class Offer
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="@todo", length="@todo")
     */
    private description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length="20")
     */
    private $type;

    /**
     * @var float ? @todo
     *
     * @ORM\Column(name="price", type="float", length=@todo)
     */
    private $price;

    /**
     * @var boolean ? @todo
     *
     * @ORM\Column(name="active", type="boolean ? @todo")
     */
    private $active;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="submitted_at", type="datetime")
     */
    private $submitted_at;

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
     * @param float ? @todo $price
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
     * @return float ? @todo
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set active
     *
     * @param boolean ? @todo $active
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
     * @return boolean ? @todo
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
    public function setSubmittedAt()
    {
        return $this->submitted_at;
    }

}
