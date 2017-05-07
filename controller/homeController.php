<?php

require_once("controller.php");

require_once(VIEW_PATH . "/home.php");
require_once(MODEL_PATH . "/homeViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class HomeController extends Controller {
    private $customBikes;

    function __construct(CustomBikeRepository $repo) {
        $this->customBikes = $repo;
    }

    public function index() {
        $highlights = $this->getHighlights();
        $latest = $this->getLatest();

        $model = new HomeViewModel($highlights, $latest);
        return new Home($model);
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