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

    function __construct($id, $name, $image, $price, $category, $description, $dateAdded, $isHighlighted) {
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