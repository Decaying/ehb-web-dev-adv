<?php

require_once(MODEL_PATH . "/cart/addressViewModel.php");

use cart\AddressViewModel;

class OrderDetailViewModel {
    private $firstname;
    private $lastname;
    private $dlvMethod;
    private $invMethod;
    private $dlvAddress;
    private $invAddress;
    private $id;
    private $orderLines;

    function __construct($id, $firstname, $lastname, $dlvMethod, $invMethod, AddressViewModel $dlvAddress, AddressViewModel $invAddress, array $orderLines) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->dlvMethod = $dlvMethod;
        $this->invMethod = $invMethod;
        $this->dlvAddress = $dlvAddress;
        $this->invAddress = $invAddress;
        $this->id = $id;
        $this->orderLines = $orderLines;
    }

    /**
     * @return int
     */
    public function getId() {
        return (int)$this->id;
    }

    /**
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getDlvMethod() {
        return $this->dlvMethod;
    }

    /**
     * @return string
     */
    public function getInvMethod() {
        return $this->invMethod;
    }

    /**
     * @return AddressViewModel
     */
    public function getDlvAddress() {
        return $this->dlvAddress;
    }

    /**
     * @return AddressViewModel
     */
    public function getInvAddress() {
        return $this->invAddress;
    }

    /**
     * @return array
     */
    public function getOrderLines() {
        return $this->orderLines;
    }
}