<?php

class CustomBikeViewModel {
    public $name;
    public $description;
    public $image;
    public $id;
    private $price;
    public $category;
    public $isHighlighted;

    function __construct($id, $name, $image, $description, $price, $category, $isHighlighted) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->isHighlighted = $isHighlighted;
    }

    public function getPriceWithCurrency() {
        return '&euro; ' . $this->getPrice();
    }

    public function getPrice() {
        return number_format($this->price, 2, '.', '');
    }

    public static function FromCustomBikes(array $bikes) {
        $vms = array();

        foreach($bikes as $bike){
            $vms[] = CustomBikeViewModel::FromCustomBike($bike);
        }

        return $vms;
    }

    public static function FromCustomBike(CustomBike $bike) {
        return new CustomBikeViewModel($bike->id, $bike->name, $bike->image, $bike->description, $bike->price, $bike->category, $bike->isHighlighted);
    }
}