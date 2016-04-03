<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MinifigureSet
 *
 * @ORM\Table(name="brickskeeper_minifigure_set", options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinifigureSetRepository")
 */
class MinifigureSet
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
     * @ORM\Column(name="item_count", type="integer")
     */
    private $item_count;

    /**
     * @var Minifigure
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Minifigure", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $minifigure;

    /**
     * @var Set
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Set", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $set;

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
     * @return MinifigureSet
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

    /**
     * Set minifigure
     *
     * @param Minifigure $minifigure
     *
     * @return MinifigureSet
     */
    public function setMinifigure($minifigure)
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
     * @return MinifigureSet
     */
    public function setSet($set)
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

}