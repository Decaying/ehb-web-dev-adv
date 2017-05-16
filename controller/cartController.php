<?php

use cart\AddressViewModel;
use cart\Checkout;
use cart\CheckoutComplete;
use cart\CheckoutCompleteViewModel;
use cart\CheckoutViewModel;
use cart\Index;
use cart\IndexViewModel;
use cart\LoginOrRegisterFirst;

require_once("controller.php");

require_once(VIEW_PATH . "/cart/index.php");
require_once(VIEW_PATH . "/cart/loginOrRegisterFirst.php");
require_once(VIEW_PATH . "/cart/checkout.php");
require_once(VIEW_PATH . "/cart/checkoutComplete.php");
require_once(MODEL_PATH . "/cart/indexViewModel.php");
require_once(MODEL_PATH . "/cart/checkoutViewModel.php");
require_once(MODEL_PATH . "/cart/addressViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(MODEL_PATH . "/cart/checkoutCompleteViewModel.php");
require_once(SERVICE_PATH . "/model/cartItem.php");
require_once(SERVICE_PATH . "/sessionCartManager.php");
require_once(SERVICE_PATH . "/orderRepository.php");

class CartController extends Controller {

    private $customBikes;
    private $cart;
    private $auth;
    private $orders;

    function __construct(CustomBikeRepository $bikes, SessionCartManager $cart, AuthenticationManager $auth, OrderRepository $orders) {
        $this->customBikes = $bikes;
        $this->cart = $cart;
        $this->auth = $auth;
        $this->orders = $orders;
    }

    public function index() {
        $itemsInCart = $this->getItemsInCart();
        $bikes = $this->getBikesInCart($itemsInCart);
        $model = new IndexViewModel($itemsInCart, $bikes);

        return new Index($model);
    }

    private function getItemsInCart() {
        return $this->cart->getCart();
    }

    private function getBikesInCart(array $itemsInCart) {
        $bikes = array();

        foreach ($itemsInCart as $item) {
            $bikes[$item->bikeId] = $this->getBike($item);
        }

        return $bikes;
    }

    /**
     * @param CartItem $purch
     * @return CustomBike
     */
    private function getBike(CartItem $purch) {
        return $this->customBikes->searchById($purch->bikeId);
    }

    public function checkout() {
        if (!$this->auth->isUserLoggedIn()){
            return new LoginOrRegisterFirst();
        } else {
            if ($this->hasPostValue("form-id") && $_POST['form-id'] === "checkout"){
                $vm = $this->completeCheckout();

                $this->cart->clearCart();
                return new CheckoutComplete($vm);
            } else {
                $user = $this->auth->getUser();
                return new Checkout($this->map($user));
            }
        }
    }

    private function map(User $user) {
        $fullname = $user->getFirstname() . ' ' . $user->getLastname();

        return new CheckoutViewModel($fullname);
    }

    private function completeCheckout() {
        $itemsInCart = $this->getItemsInCart();
        $user = $this->auth->getUser();

        $bikes = $this->getBikesInCartAsViewModel($itemsInCart);

        $useDlvAsInv = $this->hasPostValue('useDlvAsInv');

        $dlvAddress = new Address($_POST['dlvStreet'], $_POST['dlvZipcode'], $_POST['dlvCity']);
        $dlvAddressVm = new AddressViewModel($dlvAddress);

        $invAddress = $dlvAddress;
        $invAddressVm = $dlvAddressVm;

        if (!$useDlvAsInv) {
            $invAddress = new Address($_POST['invStreet'], $_POST['invZipcode'], $_POST['invCity']);

            $invAddressVm = new AddressViewModel($invAddress);
        }

        $agreedToTerms = $this->hasPostValue('agreeToTerms');
        $invMethod = $_POST['invMethod'];
        $dlvMethod = $_POST['dlvMethod'];

        $this->orders->add($user, $itemsInCart, $invAddress, $dlvAddress, $invMethod, $dlvMethod, $agreedToTerms);

        return new CheckoutCompleteViewModel($bikes, $dlvAddressVm, $invAddressVm, $agreedToTerms, $invMethod, $dlvMethod);
    }

    private function getBikesInCartAsViewModel(array $itemsInCart) {
        $bikes = $this->getBikesInCart($itemsInCart);

        return CustomBikeViewModel::FromCustomBikes($bikes);
    }
}