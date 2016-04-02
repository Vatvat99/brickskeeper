<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Collection
 *
 * @ORM\Table(name="brickskeeper_collection_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CollectionItemRepository")
 */
class CollectionItem
{

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Minifigure", cascade={"persist"})
     */
    private $minifigure;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Set", cascade={"persist"})
     */
    private $set;

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
     * @ORM\Column(name="item_count", type="integer")
     */
    private $item_count;

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
     * Set user
     *
     * @param User $user
     *
     * @return CollectionItem
     */
    public function setUser(User $user)
    {
        $this->user = $user

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
     * Set minifigure
     *
     * @param Minifigure $minifigure
     *
     * @return CollectionItem
     */
    public function setMinifigure(Minifigure $minifigure)
    {
        $this->minifigure = $minifigure

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
     * Set set
     *
     * @param Set $set
     *
     * @return CollectionItem
     */
    public function setSet(Set $set)
    {
        $this->set = $set

        return $this;
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
     * Set item_count
     *
     * @param int $item_count
     *
     * @return Collection
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
