<?php

namespace Apitic\AnimalsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animals
 *
 * @ORM\Table(name="animals")
 * @ORM\Entity(repositoryClass="Apitic\AnimalsBundle\Repository\AnimalsRepository")
 */
class Animals
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
     * @ORM\Column(name="scale", type="string", length=255, nullable=true)
     */
    private $scale;

    /**
     * @var string
     *
     * @ORM\Column(name="fur", type="string", length=255, nullable=true)
     */
    private $fur;

    /**
     * @var string
     *
     * @ORM\Column(name="feathers", type="string", length=255, nullable=true)
     */
    private $feathers;

    /**
     * @ORM\ManyToOne(targetEntity="Apitic\AnimalsBundle\Entity\Types", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Animals
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
     * Set scale
     *
     * @param string $scale
     * @return Animals
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return string 
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set fur
     *
     * @param string $fur
     * @return Animals
     */
    public function setFur($fur)
    {
        $this->fur = $fur;

        return $this;
    }

    /**
     * Get fur
     *
     * @return string 
     */
    public function getFur()
    {
        return $this->fur;
    }

    /**
     * Set feathers
     *
     * @param string $feathers
     * @return Animals
     */
    public function setFeathers($feathers)
    {
        $this->feathers = $feathers;

        return $this;
    }

    /**
     * Get feathers
     *
     * @return string 
     */
    public function getFeathers()
    {
        return $this->feathers;
    }

    /**
     * Set type
     *
     * @param \Apitic\AnimalsBundle\Entity\Types $type
     * @return Animals
     */
    public function setType(\Apitic\AnimalsBundle\Entity\Types $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Apitic\AnimalsBundle\Entity\Types 
     */
    public function getType()
    {
        return $this->type;
    }
}
