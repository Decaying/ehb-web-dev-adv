<?php

namespace bikes;

require_once(VIEW_PATH . "/view.php");
require_once(VIEW_PATH . "/bike.php");

use Bike;
use View;

class Detail implements View {
    private $model;

    function __construct(DetailViewModel $model) {
        $this->model = $model;
    }

    public function render() {
        echo '
        <h2>' . $this->model->bike->name . '</h2>
        <p> Categorie: ' . $this->model->bike->category . '</p>
        <p>' . $this->model->bike->description . '</p>
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6">
        
        <p><img src="' . $this->model->bike->image . '" class="img-responsive img-thumbnail"></p>
        
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <p>Price : ' . $this->model->bike->price . '</p>
        <p><a href="#" data-id="' . $this->model->bike->id . '" class="btn btn-success shop-item-button">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Add to cart
        </a></p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> Gratis afhaling</p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> Gratis levering</p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> 30 dagen bedenktijd</p>
    </div>
</div>';
        if (count($this->model->sameCategory) > 0) {
            echo '<h3>Here\'s a selection from the same category</h3>';

            Bike::renderBikes($this->model->sameCategory);
        }
    }
}