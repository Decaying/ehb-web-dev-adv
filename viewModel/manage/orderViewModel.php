<?php
use cart\AddressViewModel;

require_once(MODEL_PATH . "/cart/addressViewModel.php");

class OrderViewModel {
    private $firstname;
    private $lastname;
    private $dlvMethod;
    private $invMethod;
    private $dlvAddress;
    private $invAddress;
    private $id;

    function __construct($id, $firstname, $lastname, $dlvMethod, $invMethod, AddressViewModel $dlvAddress, AddressViewModel $invAddress) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->dlvMethod = $dlvMethod;
        $this->invMethod = $invMethod;
        $this->dlvAddress = $dlvAddress;
        $this->invAddress = $invAddress;
        $this->id = $id;
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
}