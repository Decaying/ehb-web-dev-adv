<?php

class CustomBikeViewModel {
    public $name;
    public $image;
    public $id;

    function __construct($id, $name, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }

    public static function FromCustomBikes(array $bikes) {
        $vms = array();

        foreach($bikes as $bike){
            $vms[] = CustomBikeViewModel::FromCustomBike($bike);
        }

        return $vms;
    }

    public static function FromCustomBike(CustomBike $bike) {
        return new CustomBikeViewModel($bike->id, $bike->name, $bike->image);
    }
}