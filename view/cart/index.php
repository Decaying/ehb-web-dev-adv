<?php

namespace cart;

use CustomBike;
use Purchase;
use View;

require_once(VIEW_PATH . "/view.php");
require_once(SERVICE_PATH . "/customBike.php");
require_once(SERVICE_PATH . "/purchase.php");

class Index implements View {

    private $index;
    private $totalPrice;

    function __construct(IndexViewModel $index) {
        $this->index = $index;
        $this->totalPrice = 0;
    }

    function render() {

        if (count($this->index->purchases) === 0) {
            echo '<h3>Your cart is empty!</h3>';
            echo '<p>Please visit the <a href="' . SITE_ROOT . '/bikes"> overview </a> to look for any bike you like or search for any bike in the navigation bar on the top of the page.</p>';
        } else {
            echo '<h3>Cart</h3>';
            echo '<ul>';

            foreach ($this->index->purchases as $purchase) {
                $this->renderBikeInCart($purchase, $this->index->bikes[$purchase->bikeId]);
            }

            echo '</ul>';
            echo '<p>For a total amount of : &euro; ' . $this->asNumber($this->totalPrice) . '</p>';
            echo '<a class="btn btn-success" id="checkout" href="' . SITE_ROOT . '/cart/checkout">Checkout</a>';
        }
    }

    private function renderBikeInCart(Purchase $purch, CustomBike $bike) {
        $price = $bike->price * $purch->amount;
        $this->totalPrice += $price;
        echo '<li>' . $purch->amount . ' x ' . $bike->name .' = &euro;' . $this->asNumber($price) . '</li>';
    }

    private function asNumber($number) {
        return number_format($number, 2);
    }
}