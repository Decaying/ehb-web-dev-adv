<?php

use bikes\Detail;
use bikes\DetailViewModel;
use bikes\Index;
use bikes\IndexViewModel;

require_once("controller.php");

require_once(VIEW_PATH . "/bikes/detail.php");
require_once(VIEW_PATH . "/bikes/index.php");
require_once(VIEW_PATH . "/notFound.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(MODEL_PATH . "/bikes/indexViewModel.php");
require_once(MODEL_PATH . "/bikes/detailViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class BikesController implements Controller {
    const NumberOfBikesFromSameCategory = 4;

    private $customBikes;

    function __construct(CustomBikeRepository $customBikes) {
        $this->customBikes = $customBikes;
    }

    public function index() {
        $args = func_get_args();
        if (count($args) == 1){
            return $this->indexById($args[0]);
        } else {
            return $this->indexForAll();
        }
    }

    private function indexForAll() {
        $all = $this->getAll();
        $categories = $this->getCategories();

        $model = new IndexViewModel($all, $categories);

        return new Index($model);
    }

    private function indexById($id) {
        $bike = $this->getById($id);

        if (!$bike) {
            return new NotFound("Bike with id " . $id . " does not exist.");
        }

        $sameCategory = $this->getSameCategory($bike);

        $model = new DetailViewModel($this->toBikeVm($bike), $this->toBikeVms($sameCategory));

        return new Detail($model);
    }

    private function toBikeVm(CustomBike $bike) {
        return CustomBikeViewModel::FromCustomBike($bike);
    }

    private function toBikeVms(array $bikes) {
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }

    private function getById($id) {
        return $this->customBikes->searchById($id);
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

    private function getCategories() {
        return $this->customBikes->getCategories();
    }
}