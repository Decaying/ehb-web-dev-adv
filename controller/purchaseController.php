<?php

require_once("apiController.php");

require_once(SERVICE_PATH . "/customBikeRepository.php");
require_once(SERVICE_PATH . "/purchaseRepository.php");

class PurchaseController implements ApiController {

    private $customBikes;
    private $purchases;

    function __construct(CustomBikeRepository $bikes, PurchaseRepository $purchases) {
        $this->customBikes = $bikes;
        $this->purchases = $purchases;
    }

    public function buy($id) {
        $bike = $this->customBikes->searchById($id);
        if ($bike !== false) {
            $this->addToCart($bike);

            return json_encode($bike);
        } else {
            header('X-PHP-Response-Code: 404', true, 404);
            throw new Exception("Custom bike with id " . $bike->id . " not found.");
        }
    }

    public function count(){
        return $this->purchases->getNumberOfItemsInCart();
    }

    private function addToCart(CustomBike $bike) {
        $this->purchases->addToCart($bike);
    }
}