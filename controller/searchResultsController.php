<?php
require_once(VIEW_PATH . "/searchResults.php");
require_once(MODEL_PATH . "/searchResultsViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class SearchResultsController {
    private $customBikes;

    function __construct() {
        $this->customBikes = new CustomBikeRepository();
    }

    public function index($query) {
        $view = new SearchResults();
        $model = new SearchResultsViewModel($query, $this->getSearchResults($query));
        $view->render($model);
    }

    private function getSearchResults($query) {
        $bikes = $this->customBikes->searchByName($query);
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }
}