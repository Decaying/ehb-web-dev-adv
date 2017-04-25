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
        $latest = $this->getLatest();

        $view = new Home();
        $model = new HomeViewModel($highlights, $latest);
        $view->render($model);
    }

    public function getHighlights() {
        $allBikes = $this->customBikes->getHighlightedBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }

    public function getLatest() {
        $allBikes = $this->customBikes->getLatestBikes();
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }
}