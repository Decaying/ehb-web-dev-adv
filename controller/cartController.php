<?php

use cart\Index;
use cart\IndexViewModel;

require_once("controller.php");

require_once(VIEW_PATH . "/cart/index.php");
require_once(MODEL_PATH . "/cart/indexViewModel.php");
require_once(SERVICE_PATH . "/sessionPurchaseManager.php");

class CartController extends Controller {

    private $customBikes;
    private $purchases;

    function __construct(CustomBikeRepository $bikes, SessionPurchaseManager $purchases) {
        $this->customBikes = $bikes;
        $this->purchases = $purchases;
    }

    public function index() {
        $purchases = $this->getPurchases();
        $bikes = $this->getBikes($purchases);
        $model = new IndexViewModel($purchases, $bikes);

        return new Index($model);
    }

    private function getPurchases() {
        return $this->purchases->getCart();
    }

    private function getBikes(array $purchases) {
        $bikes = array();

        foreach ($purchases as $purch) {
            $bikes[$purch->bikeId] = $this->getBike($purch);
        }

        return $bikes;
    }

    private function getBike(Purchase $purch) {
        return $this->customBikes->searchById($purch->bikeId);
    }
}