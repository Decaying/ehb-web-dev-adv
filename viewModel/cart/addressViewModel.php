<?php

namespace cart;


use Address;

require_once("addressViewModel.php");

class AddressViewModel {
    private $street;
    private $zipcode;
    private $city;

    function __construct(Address $address) {
        $this->street = $address->getStreet();
        $this->zipcode = $address->getZipcode();
        $this->city = $address->getCity();
    }

    /**
     * @return string
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZipcode() {
        return $this->zipcode;
    }

    /**
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

}