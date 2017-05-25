<?php

class OrderLine {
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

    /**
     * @return int
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getUnitPrice() {
        return $this->unitPrice;
    }
}