<?php

require_once("apiController.php");

require_once(VIEW_PATH . "/notFound.php");

require_once(SERVICE_PATH . "/customBikeRepository.php");
require_once(SERVICE_PATH . "/purchaseRepository.php");

class BasketController implements ApiController {

    private $customBikes;
    private $purchases;

    function __construct(CustomBikeRepository $bikes, PurchaseRepository $purchases) {
        $this->customBikes = $bikes;
        $this->purchases = $purchases;
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
        return $this->purchases->getNumberOfItemsInCart();
    }

    private function addToCart(CustomBike $bike) {
        $this->purchases->addToCart($bike);
    }
}