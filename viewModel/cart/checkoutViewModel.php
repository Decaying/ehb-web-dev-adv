<?php
/**
 * Created by PhpStorm.
 * User: HansB
 * Date: 12/05/2017
 * Time: 19:54
 */

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