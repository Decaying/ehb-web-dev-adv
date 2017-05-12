<?php

require_once("model/purchase.php");

class SessionCartManager {
    const SessionKeyCart = "cart";

    function getNumberOfItemsInCart() {
        $this->initializeSession();
        return count($_SESSION[SessionCartManager::SessionKeyCart]);
    }

    function addToCart(CustomBike $bike) {
        $this->initializeSession();
        if(array_key_exists($bike->id, $_SESSION[SessionCartManager::SessionKeyCart])){
            $purch = $_SESSION[SessionCartManager::SessionKeyCart][$bike->id];
            $purch->addOneToAmount();
        } else {
            $_SESSION[SessionCartManager::SessionKeyCart][$bike->id] = new Purchase($bike->id);
        }
    }

    private function initializeSession() {

        if(!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION[SessionCartManager::SessionKeyCart])) {
            $_SESSION[SessionCartManager::SessionKeyCart] = array();
        }
    }

    function getCart() {
        $this->initializeSession();
        if (isset($_SESSION[SessionCartManager::SessionKeyCart])) {
            return $_SESSION[SessionCartManager::SessionKeyCart];
        }
    }
}