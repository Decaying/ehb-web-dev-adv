<?php

namespace cart;


class CheckoutViewModel {

    private $deliveryName;

    function __construct($deliveryName) {
        $this->deliveryName = $deliveryName;
    }

    public function getDeliveryname() {
        return $this->deliveryName;
    }
}