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
        $bike = $this->model->bike;
        $name = $bike->name;
        $category = $bike->name;
        $description = $bike->description;
        $image = $bike->image;
        $price = $bike->getPriceWithCurrency();
        $id = $bike->id;

        echo "
<h2>$name</h2>
<p>Category: $category</p>
<p>$description</p>
<div class='row'>
    <div class='col-sm-6 col-md-6 col-lg-6'>
        
        <p><img src='$image' class='img-responsive img-thumbnail'></p>
        
    </div>
    <div class='col-sm-6 col-md-6 col-lg-6'>
        <p>Price : $price</p>
        <p><a href='#' data-id='$id' class='btn btn-success shop-item-button'>
            <span class='glyphicon glyphicon-shopping-cart'></span>
            Add to cart
        </a></p>
        <p><span class='glyphicon glyphicon-ok' style='color:green;'></span> Gratis afhaling</p>
        <p><span class='glyphicon glyphicon-ok' style='color:green;'></span> Gratis levering</p>
        <p><span class='glyphicon glyphicon-ok' style='color:green;'></span> 30 dagen bedenktijd</p>
    </div>
</div>";
        if (count($this->model->sameCategory) > 0) {
            echo "<h3>Here's a selection from the same category</h3>";

            Bike::renderBikes($this->model->sameCategory);
        }
    }
}