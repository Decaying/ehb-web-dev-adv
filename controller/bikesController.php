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
    const NumberOfBikesFromSameCategory = 4;
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
        $sameCategory = $this->getSameCategory($bike);

        $view = new Detail();
        $model = new DetailViewModel($this->toBikeVm($bike), $this->toBikeVms($sameCategory));
        $view->render($model);
    }

    private function toBikeVm(CustomBike $bike) {
        return CustomBikeViewModel::FromCustomBike($bike);
    }

    private function toBikeVms(array $bikes) {
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }

    private function getById($id) {
        return $this->customBikes->getById($id);
    }

    private function getAll() {
        $allBikes = $this->customBikes->getAllBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }

    private function getSameCategory(CustomBike $bike) {
        $sameCategory = $this->customBikes->searchByCategory($bike->category);

        $sameCategoryNotSelf = array_filter($sameCategory, function($b) use ($bike) {
            return $b->id !== $bike->id;
        });

        return array_slice($sameCategoryNotSelf, 0, BikesController::NumberOfBikesFromSameCategory);
    }
}