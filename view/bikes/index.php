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
    <select class="form-control" id="filter-bikes" style="margin-bottom: 10px;">
       <option value="">Select Category</option>';

        foreach ($this->model->categories as $key => $category) {
            echo '<option value="' . $key . '">' . $category . '</option>';
        }

        echo '
</select>
';
        Bike::renderBikes($this->model->allBikes);
    }
}