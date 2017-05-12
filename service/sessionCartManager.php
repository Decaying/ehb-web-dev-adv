<?php

require_once("model/cartItem.php");

class SessionCartManager {
    const SessionKeyCart = "cart";

    function getNumberOfItemsInCart() {
        $this->initializeSession();
        return count($_SESSION[SessionCartManager::SessionKeyCart]);
    }

    function addToCart(CustomBike $bike) {
        $this->initializeSession();
        if(array_key_exists($bike->id, $_SESSION[SessionCartManager::SessionKeyCart])){
            $cartItem = $this->getCartItem($bike);
            $cartItem->addOneToAmount();
        } else {
            $cartItem = new CartItem($bike->id);
            $this->addCartItem($cartItem);
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

    /**
     * @param CartItem $item
     * @internal param CustomBike $bike
     */
    public function addCartItem(CartItem $item) {
        $_SESSION[SessionCartManager::SessionKeyCart][$item->bikeId] = $item;
    }

    /**
     * @param CustomBike $bike
     * @return CartItem
     */
    public function getCartItem(CustomBike $bike) {
        return $_SESSION[SessionCartManager::SessionKeyCart][$bike->id];
    }
}