<?php

namespace PizzaMakerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Accessor;


/**
 * Pizza
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PizzaMakerBundle\Entity\PizzaRepository")
 */
class Pizza
{
    /**
     * @var integer
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
     * @Accessor(getter="getPrice")
     * @Expose
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="PizzaMakerBundle\Entity\Ingredient")
     */
    protected $ingredients;


    public function __construct() {
        $this->ingredients = new ArrayCollection();
    }


    /**
     * Get ingredients
     *
     * @return Ingredient[]
     */
    public function getIngredients() {
        return $this->ingredients;
    }

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
     *
     * @return Pizza
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

    public function getPrice()
    {
        $price = 0;

        $price = array_reduce($this->ingredients->toArray(), function($carry, $ingredient){
            return $carry + $ingredient->getPrice();
        }, 0);

        return round($price * 1.5, 2);
    }
}

