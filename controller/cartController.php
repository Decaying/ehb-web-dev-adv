<?php

use cart\Checkout;
use cart\CheckoutViewModel;
use cart\Index;
use cart\IndexViewModel;
use cart\LoginOrRegisterFirst;

require_once("controller.php");

require_once(VIEW_PATH . "/cart/index.php");
require_once(VIEW_PATH . "/cart/loginOrRegisterFirst.php");
require_once(VIEW_PATH . "/cart/checkout.php");
require_once(MODEL_PATH . "/cart/indexViewModel.php");
require_once(MODEL_PATH . "/cart/checkoutViewModel.php");
require_once(SERVICE_PATH . "/model/cartItem.php");
require_once(SERVICE_PATH . "/sessionCartManager.php");

class CartController extends Controller {

    private $customBikes;
    private $cart;
    private $auth;

    function __construct(CustomBikeRepository $bikes, SessionCartManager $cart, AuthenticationManager $auth) {
        $this->customBikes = $bikes;
        $this->cart = $cart;
        $this->auth = $auth;
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
        if (!$this->auth->isUserLoggedIn()){
            return new LoginOrRegisterFirst();
        } else {
            $user = $this->auth->getUser();
            return new Checkout($this->map($user));
        }
    }

    private function map(User $user) {
        $fullname = $user->getFirstname() . ' ' . $user->getLastname();

        return new CheckoutViewModel($fullname);
    }
}