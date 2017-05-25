<?php

class OrderLineViewModel {
    private $bikeId;
    private $bikeName;
    private $amount;
    private $unitPrice;

    function __construct($bikeId, $bikeName, $amount, $unitPrice) {
        $this->bikeId = $bikeId;
        $this->bikeName = $bikeName;
        $this->amount = $amount;
        $this->unitPrice = $unitPrice;
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

    private function getTotalPrice() {
        return $this->amount * $this->unitPrice;
    }

    /**
     * @return string
     */
    public function getPriceWithCurrency() {
        return '&euro; ' . number_format($this->getTotalPrice(), 2, '.', '');
    }

    /**
     * @return int
     */
    public function getAmount() {
        return $this->amount;
    }
}