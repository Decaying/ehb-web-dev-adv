<?php
require_once(VIEW_PATH . "/searchResults.php");
require_once(MODEL_PATH . "/searchResultsViewModel.php");

class SearchResultsController {
    public function index() {
        $view = new SearchResults();
        $model = new SearchResultsViewModel($this->getQuery());
        $view->render($model);
    }

    function getQuery() {
        if (isset($_GET["q"]))
            return $_GET["q"];
    }
}