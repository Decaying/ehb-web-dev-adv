<?php

require_once("apiController.php");

require_once(VIEW_PATH . "/notFound.php");

require_once(SERVICE_PATH . "/customBikeRepository.php");
require_once(SERVICE_PATH . "/sessionCartManager.php");

class BasketController implements ApiController {

    private $customBikes;
    private $cart;

    function __construct(CustomBikeRepository $bikes, SessionCartManager $cart) {
        $this->customBikes = $bikes;
        $this->cart = $cart;
    }

    public function buy($id) {
        $bike = $this->customBikes->searchById($id);

        if (!$bike) {
            return new NotFound("Bike with id " . $id . " does not exist.");
        }

        $this->addToCart($bike);

        return json_encode($bike);
    }

    public function count(){
        return $this->cart->getNumberOfItemsInCart();
    }

    private function addToCart(CustomBike $bike) {
        $this->cart->addToCart($bike);
    }
}