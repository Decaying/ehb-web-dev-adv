<?php
require_once(SERVICE_PATH . "/inMemoryCustomBikeRepository.php");

class ApiController {
    const SessionKeyCart = "cart";

    private $customBikes;

    function __construct(CustomBikeRepository $repo) {
        $this->customBikes = $repo;
    }

    public function buy($id) {
        $bike = $this->customBikes->searchById($id);
        if ($bike !== NULL) {
            $this->addToCart($bike);

            echo json_encode($bike);
        } else {
            header('X-PHP-Response-Code: 404', true, 404);
            throw new Exception("Custom bike with id " . $bike->id . " not found.");
        }
    }

    public function count(){
        $this->initializeSession();
        echo count($_SESSION[ApiController::SessionKeyCart]);
    }

    private function addToCart(CustomBike $bike) {
        $this->initializeSession();

        if(array_key_exists($bike->id, $_SESSION[ApiController::SessionKeyCart])){
            $purch = $_SESSION[ApiController::SessionKeyCart][$bike->id];
            $purch->addOneToAmount();
        } else {
            $_SESSION[ApiController::SessionKeyCart][$bike->id] = new Purchase($bike->id);
        }
    }

    private function initializeSession() {
        session_start();
        if (!isset($_SESSION[ApiController::SessionKeyCart])) {
            $_SESSION[ApiController::SessionKeyCart] = array();
        }
    }
}