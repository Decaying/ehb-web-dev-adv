<?php

require_once("controller.php");

require_once(VIEW_PATH . "/searchResults.php");
require_once(MODEL_PATH . "/searchResultsViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class SearchResultsController extends Controller{
    private $customBikes;

    function __construct(CustomBikeRepository $repo) {
        $this->customBikes = $repo;
    }

    public function index($query) {
        $results = $this->getSearchResults($query);
        $results = $results === null ? array() : $results;
        $model = new SearchResultsViewModel($query, $results);
        return new SearchResults($model);
    }

    private function getSearchResults($query) {
        $bikes = $this->customBikes->searchByName($query);
        if ($bikes === null)
            return null;
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }
}