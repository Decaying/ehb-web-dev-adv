<?php

use bikes\Index;
use bikes\IndexViewModel;

require_once(VIEW_PATH . "/bikes/index.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(MODEL_PATH . "/bikes/indexViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class BikesController {
    private $customBikes;

    function __construct() {
        $this->customBikes = new CustomBikeRepository();
    }

    public function index() {
        $all = $this->getAll();

        $view = new Index();
        $model = new IndexViewModel($all);
        $view->render($model);
    }

    public function getAll() {
        $allBikes = $this->customBikes->getAllBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }
}