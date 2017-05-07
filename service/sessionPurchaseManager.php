<?php

class SessionPurchaseManager {
    const SessionKeyCart = "cart";

    function getNumberOfItemsInCart() {
        $this->initializeSession();
        return count($_SESSION[SessionPurchaseManager::SessionKeyCart]);
    }

    function addToCart(CustomBike $bike) {
        $this->initializeSession();
        if(array_key_exists($bike->id, $_SESSION[SessionPurchaseManager::SessionKeyCart])){
            $purch = $_SESSION[SessionPurchaseManager::SessionKeyCart][$bike->id];
            $purch->addOneToAmount();
        } else {
            $_SESSION[SessionPurchaseManager::SessionKeyCart][$bike->id] = new Purchase($bike->id);
        }
    }

    private function initializeSession() {

        if(!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION[SessionPurchaseManager::SessionKeyCart])) {
            $_SESSION[SessionPurchaseManager::SessionKeyCart] = array();
        }
    }

    function getCart() {
        $this->initializeSession();
        if (isset($_SESSION[SessionPurchaseManager::SessionKeyCart])) {
            return $_SESSION[SessionPurchaseManager::SessionKeyCart];
        }
    }
}