<?php

class Address {
    private $street;
    private $zipcode;
    private $city;

    function __construct($street, $zipcode, $city) {
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
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