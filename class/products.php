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
   private $stars;

   public function __construct($id, $color, $last_updater, $updates) {
      $this->id = $id;
      $this->color = $color;
      $this->last_updater = $last_updater;
      $this->updates = $updates;
   }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @param mixed $last_updater
     */
    public function setLastUpdater($last_updater)
    {
        $this->last_updater = $last_updater;
    }

    /**
     * @param mixed $updates
     */
    public function setUpdates($updates)
    {
        $this->updates = $updates;
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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getLastUpdater()
    {
        return $this->last_updater;
    }

    /**
     * @return mixed
     */
    public function getUpdates()
    {
        return $this->updates;
    }
}