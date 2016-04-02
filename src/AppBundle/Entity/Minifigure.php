<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Minifigure
 *
 * @ORM\Table(name="brickskeeper_minifigure")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MinifigureRepository")
 */
class Minifigure
{

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Serie", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;
    
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
        $this->serie = $serie

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
     * Set alias
     *
     * @param string $alias
     *
     * @return Minifigure
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
    
}
