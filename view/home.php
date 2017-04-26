<?php

require_once("view.php");
require_once("bike.php");

class Home implements View {
    private $model;

    function __construct(HomeViewModel $model) {
        $this->model = $model;
    }

    function render() {
        echo '<p>This is the home page for the Custom Bikes webshop.</p>';


        echo '<h1>These ones have been specially picked for you.</h1>';
        Bike::renderBikes($this->model->highlights);

        echo '<h1>Here is a selection of the latest models.</h1>';
        Bike::renderBikes($this->model->latest);
    }
}