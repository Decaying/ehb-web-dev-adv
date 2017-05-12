<?php

use cart\Index;
use cart\IndexViewModel;

require_once("controller.php");

require_once(VIEW_PATH . "/cart/index.php");
require_once(MODEL_PATH . "/cart/indexViewModel.php");
require_once(SERVICE_PATH . "/model/cartItem.php");
require_once(SERVICE_PATH . "/sessionCartManager.php");

class CartController extends Controller {

    private $customBikes;
    private $cart;

    function __construct(CustomBikeRepository $bikes, SessionCartManager $cart) {
        $this->customBikes = $bikes;
        $this->cart = $cart;
    }

    public function index() {
        $purchases = $this->getPurchases();
        $bikes = $this->getBikesInCart($purchases);
        $model = new IndexViewModel($purchases, $bikes);

        return new Index($model);
    }

    private function getPurchases() {
        return $this->cart->getCart();
    }

    private function getBikesInCart(array $purchases) {
        $bikes = array();

        foreach ($purchases as $purch) {
            $bikes[$purch->bikeId] = $this->getBike($purch);
        }

        return $bikes;
    }

    private function getBike(CartItem $purch) {
        return $this->customBikes->searchById($purch->bikeId);
    }

    public function checkout() {

    }
}