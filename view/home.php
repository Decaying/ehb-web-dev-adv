<?php
require_once ("bike.php");

class Home {
    function render(HomeViewModel $model) {
        echo '<p>This is the home page for the Custom Bikes webshop.</p>';


        echo '<h1>These ones have been specially picked for you.</h1>';
        Bike::renderBikes($model->highlights);
    }

    function renderBike(CustomBikeViewModel $model) {
        $bike = new Bike($model);
        $bike->renderBikeAsThumbnail();
    }
}

