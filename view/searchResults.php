<?php
require_once ("bike.php");
require_once ("view.php");

class SearchResults implements View {

    protected $model;

    function __construct(SearchResultsViewModel $model) {
        $this->model = $model;
    }

    function render() {
        echo '<h1>Displaying search results for <strong>'.$this->model->query.'</strong></h1>';
        Bike::renderBikes($this->model->results);
    }

    function renderBike(CustomBikeViewModel $model) {
        $bike = new Bike($model);
        $bike->renderBikeAsThumbnail();
    }
}