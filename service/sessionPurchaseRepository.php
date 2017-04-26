<?php

require_once("purchaseRepository.php");

class SessionPurchaseRepository implements PurchaseRepository {
    const SessionKeyCart = "cart";

    function getNumberOfItemsInCart() {
        $this->initializeSession();
        return count($_SESSION[SessionPurchaseRepository::SessionKeyCart]);
    }

    function addToCart(CustomBike $bike) {
        $this->initializeSession();
        if(array_key_exists($bike->id, $_SESSION[SessionPurchaseRepository::SessionKeyCart])){
            $purch = $_SESSION[SessionPurchaseRepository::SessionKeyCart][$bike->id];
            $purch->addOneToAmount();
        } else {
            $_SESSION[SessionPurchaseRepository::SessionKeyCart][$bike->id] = new Purchase($bike->id);
        }
    }

    private function initializeSession() {
        session_start();
        if (!isset($_SESSION[SessionPurchaseRepository::SessionKeyCart])) {
            $_SESSION[SessionPurchaseRepository::SessionKeyCart] = array();
        }
    }
}