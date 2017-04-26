<?php

require_once("controller.php");

require_once(VIEW_PATH . "/searchResults.php");
require_once(MODEL_PATH . "/searchResultsViewModel.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");
require_once(SERVICE_PATH . "/customBikeRepository.php");

class SearchResultsController implements Controller{
    private $customBikes;

    function __construct(CustomBikeRepository $repo) {
        $this->customBikes = $repo;
    }

    public function index($query) {
        $model = new SearchResultsViewModel($query, $this->getSearchResults($query));
        return new SearchResults($model);
    }

    private function getSearchResults($query) {
        $bikes = $this->customBikes->searchByName($query);
        return CustomBikeViewModel::FromCustomBikes($bikes);
    }
}