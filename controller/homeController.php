<?php
require_once(VIEW_PATH . "/home.php");
require_once(MODEL_PATH . "/homeViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class HomeController {
    private $customBikes;

    function __construct() {
        $this->customBikes = new CustomBikeRepository();
    }

    public function index() {
        $highlights = $this->getHighlights();

        $view = new Home();
        $model = new HomeViewModel($highlights);
        $view->render($model);
    }

    public function getHighlights() {
        $allBikes = $this->customBikes->getHighlightedBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }
}