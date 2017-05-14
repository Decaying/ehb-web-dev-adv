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

        $highlights = $highlights === null ? array() : $highlights;
        $latest = $latest === null ? array() : $latest;

        $model = new HomeViewModel($highlights, $latest);
        return new Home($model);
    }

    public function getHighlights() {
        $allBikes = $this->customBikes->getHighlightedBikes();
        if ($allBikes === null)
            return null;
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }

    public function getLatest() {
        $allBikes = $this->customBikes->getLatestBikes();
        if ($allBikes === null)
            return null;
        return CustomBikeViewModel::FromCustomBikes($allBikes);
    }
}