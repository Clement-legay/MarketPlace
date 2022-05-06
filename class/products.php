<?php

class products
{
   private $id;
   private $name;
   private $society;
   private $itemsLeft;
   private $price;
   private $description;
   private $image;
   private $category;

   public function __construct($id, $name, $society, $itemsLeft, $price, $description, $image, $category)
   {
      $this->id = $id;
      $this->name = $name;
      $this->society = $society;
      $this->itemsLeft = $itemsLeft;
      $this->price = $price;
      $this->description = $description;
      $this->image = $image;
      $this->category = $category;
   }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $society
     */
    public function setSociety($society)
    {
        $this->society = $society;
    }

    /**
     * @return mixed
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * @return mixed
     */
    public function getItemsLeft()
    {
        return $this->itemsLeft;
    }

    /**
     * @param mixed $itemsLeft
     */
    public function setItemsLeft($itemsLeft)
    {
        $this->itemsLeft = $itemsLeft;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}