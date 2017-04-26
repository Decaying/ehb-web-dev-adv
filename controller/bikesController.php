<?php

use bikes\Detail;
use bikes\DetailViewModel;
use bikes\Index;
use bikes\IndexViewModel;

require_once(VIEW_PATH . "/bikes/detail.php");
require_once(VIEW_PATH . "/bikes/index.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(MODEL_PATH . "/bikes/indexViewModel.php");
require_once(MODEL_PATH . "/bikes/detailViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class BikesController {
    private $customBikes;

    function __construct() {
        $this->customBikes = new CustomBikeRepository();
    }

    public function index() {
        $args = func_get_args();
        if (count($args) == 1){
            $this->indexById($args[0]);
        } else {
            $this->indexForAll();
        }
    }

    private function indexForAll() {
        $all = $this->getAll();

        $view = new Index();
        $model = new IndexViewModel($all);
        $view->render($model);
    }

    private function indexById($id) {
        $bike = $this->getById($id);

        $view = new Detail();
        $model = new DetailViewModel($bike);
        $view->render($model);
    }

    private function getById($id) {
        $bike = $this->customBikes->getById($id);
        return CustomBikeViewModel::FromCustomBike($bike);
    }

    private function getAll() {
        $allBikes = $this->customBikes->getAllBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }
}