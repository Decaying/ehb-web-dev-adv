<?php
require_once ("bike.php");

class SearchResults {
    function render(SearchResultsViewModel $model) {
        echo '<h1>Displaying search results for <strong>'.$model->query.'</strong></h1>';
        Bike::renderBikes($model->results);
    }

    function renderBike(CustomBikeViewModel $model) {
        $bike = new Bike($model);
        $bike->renderBikeAsThumbnail();
    }
}