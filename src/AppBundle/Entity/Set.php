<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Set
 *
 * @ORM\Table(name="brickskeeper_set")
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
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

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
     * @var float ? @todo
     * 
     * @ORM\Column(name="price", type="float", length=@todo)
     */
    private $price;

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
     * Set alias
     *
     * @param string $alias
     *
     * @return Set
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
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
     * Set releaseYear
     *
     * @param \DateTime $releaseYear
     *
     * @return Set
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

}
