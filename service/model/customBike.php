<?php

class CustomBike {
    public $id;
    public $name;
    public $image;
    public $category;
    public $price;
    public $description;
    public $dateAdded;
    public $isHighlighted;

    function __construct($name, $category, $price, $description, $image, $isHighlighted, $id = null, $dateAdded = null) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->price = $price;
        $this->category = $category;
        $this->description = $description;
        $this->dateAdded = $dateAdded;
        $this->isHighlighted = $isHighlighted;
    }
}