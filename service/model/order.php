<?php

/**
 * Created by PhpStorm.
 * User: HansB
 * Date: 22/05/2017
 * Time: 21:18
 */
class Order {
    private $userFirstname;
    private $userLastname;
    private $dlvMethod;
    private $invMethod;
    private $dlv;
    private $inv;
    private $id;

    function __construct($id, $userFirstname, $userLastname, $dlvMethod, $invMethod, Address $dlv, Address $inv) {
        $this->userFirstname = $userFirstname;
        $this->userLastname = $userLastname;
        $this->dlvMethod = $dlvMethod;
        $this->invMethod = $invMethod;
        $this->dlv = $dlv;
        $this->inv = $inv;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserFirstname() {
        return $this->userFirstname;
    }

    /**
     * @return string
     */
    public function getUserLastname() {
        return $this->userLastname;
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
     * @return Address
     */
    public function getDeliveryAddress() {
        return $this->dlv;
    }

    /**
     * @return Address
     */
    public function getInvoiceAddress() {
        return $this->inv;
    }
}