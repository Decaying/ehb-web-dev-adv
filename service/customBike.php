<?php

class CustomBike {
    public $id;
    public $name;
    public $image;

    function __construct($id, $name, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }
}