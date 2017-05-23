<?php

class OrderLineViewModel {
    private $bikeId;
    private $bikeName;
    private $amount;

    function __construct($bikeId, $bikeName, $amount) {
        $this->bikeId = $bikeId;
        $this->bikeName = $bikeName;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getBikeId() {
        return $this->bikeId;
    }

    /**
     * @return string
     */
    public function getBikeName() {
        return $this->bikeName;
    }

    /**
     * @return string
     */
    public function getAmountWithCurrency() {
        return '&euro; ' . number_format($this->amount, 2, '.', '');
    }
}