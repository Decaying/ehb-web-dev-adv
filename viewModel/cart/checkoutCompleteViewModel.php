<?php

namespace cart;

class CheckoutCompleteViewModel {

    private $dlvAddress;
    private $invAddress;
    private $agreedToTerms;
    private $paymentMethod;
    private $deliveryMethod;
    private $bikes;

    function __construct(array $bikes,AddressViewModel $dlvAddress, AddressViewModel $invAddress, $agreedToTerms, $paymentMethod, $deliveryMethod) {
        $this->dlvAddress = $dlvAddress;
        $this->invAddress = $invAddress;
        $this->agreedToTerms = $agreedToTerms;
        $this->paymentMethod = $paymentMethod;
        $this->deliveryMethod = $deliveryMethod;
        $this->bikes = $bikes;
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
     * @return bool
     */
    public function getAgreedToTerms() {
        return $this->agreedToTerms;
    }

    /**
     * @return string
     */
    public function getPaymentMethod() {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function getDeliveryMethod() {
        return $this->deliveryMethod;
    }

    /**
     * @return array
     */
    public function getBikes() {
        return $this->bikes;
    }

}