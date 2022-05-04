<?php

class seller
{
    private $id;
    private $society;

    public function __construct($id, $society)
    {
        $this->id = $id;
        $this->society = $society;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * @param mixed $society
     */
    public function setSociety($society)
    {
        $this->society = $society;
    }
}