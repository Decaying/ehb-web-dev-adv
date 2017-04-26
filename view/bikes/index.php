<?php

namespace bikes;

require_once (VIEW_PATH . "/bike.php");

use Bike;

class Index {
    function render(IndexViewModel $model) {
        echo '
<h1>Displaying an overview of all available bikes.</h1>
<div class="container">
    <input type="text" id="filter-bikes" placeholder="Which shall I display?"/>
</div>
';
        Bike::renderBikes($model->allBikes);
    }
}