<?php

class CartItem {
    public $bikeId;
    public $amount;

    function __construct($id) {
        $this->bikeId = $id;
        $this->amount = 1;
    }

    public function addOneToAmount() {
        $this->amount++;
    }
}