<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionItem
 *
 * @ORM\Table(name="brickskeeper_collection_item", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CollectionItemRepository")
 */
class CollectionItem
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Minifigure", inversedBy="collection_items", cascade={"persist"})
     */
    private $minifigure;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Set", inversedBy="collection_items", cascade={"persist"})
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
     * Set user
     *
     * @param User $user
     *
     * @return CollectionItem
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
     * Set minifigure
     *
     * @param Minifigure $minifigure
     *
     * @return CollectionItem
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
     * @return CollectionItem
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
     * @return CollectionItem
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
