<?php

require_once("view.php");
require_once("bike.php");

class Home implements View {
    private $model;

    function __construct(HomeViewModel $model) {
        $this->model = $model;
    }

    function render() {
        global $config;

        echo '<div class="jumbotron"><h1>Custom Bikes webshop</h1></div>';

        $hasHighlights = count($this->model->highlights) > 0;
        $hasLatest = count($this->model->latest) > 0;

        if ($hasHighlights) {
            echo '<h3>These ones have been specially picked for you.</h3>';
            Bike::renderBikes($this->model->highlights);
        }

        if ($hasLatest) {
            echo '<h3>Here is a selection of the latest models.</h3>';
            Bike::renderBikes($this->model->latest);
        }

        if (!$hasHighlights && !$hasLatest){
            echo '<h3>Currently the shop is empty.</h3>';
            echo '<p>Please call us at <a href="tel:' . $config['phone'] . '">' . $config['phone'] . '</a> or email to <a href="mailto:' . $config['email'] . '">' . $config['email'] . '</a> for more information</p>';
        }
    }
}