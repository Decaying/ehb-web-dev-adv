<?php

namespace bikes;

require_once(VIEW_PATH . "/view.php");
require_once(VIEW_PATH . "/bike.php");

use Bike;
use View;

class Index implements View {
    private $model;

    function __construct(IndexViewModel $model) {
        $this->model = $model;
    }

    function render() {
        echo '
<h1>Displaying an overview of all available bikes.</h1>
<div class="container">
    <input type="text" id="filter-bikes" placeholder="Which shall I display?"/>
</div>
';
        Bike::renderBikes($this->model->allBikes);
    }
}