<?php
require_once(SERVICE_PATH . "/customBikeRepository.php");

class ApiController {
    private $bikeRepo;

    function __construct() {
        $this->bikeRepo = new CustomBikeRepository();
    }

    public function buy($id) {
        echo json_encode($this->bikeRepo->getById($id));
    }
}