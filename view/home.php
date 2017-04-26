<?php

require_once("view.php");
require_once("bike.php");

class Home implements View {
    private $model;

    function __construct(HomeViewModel $model) {
        $this->model = $model;
    }

    function render() {
        echo '<div class="jumbotron"><h1>Custom Bikes webshop</h1></div>';


        echo '<h3>These ones have been specially picked for you.</h3>';
        Bike::renderBikes($this->model->highlights);

        echo '<h3>Here is a selection of the latest models.</h3>';
        Bike::renderBikes($this->model->latest);
    }
}