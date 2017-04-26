<?php

class CustomBikeViewModel {
    public $name;
    public $description;
    public $image;
    public $id;
    public $price;
    public $category;

    function __construct($id, $name, $image, $description, $price, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = '&euro; ' . number_format($price, 2);
        $this->category = $category;
    }

    public static function FromCustomBikes(array $bikes) {
        $vms = array();

        foreach($bikes as $bike){
            $vms[] = CustomBikeViewModel::FromCustomBike($bike);
        }

        return $vms;
    }

    public static function FromCustomBike(CustomBike $bike) {
        return new CustomBikeViewModel($bike->id, $bike->name, $bike->image, $bike->description, $bike->price, $bike->category);
    }
}