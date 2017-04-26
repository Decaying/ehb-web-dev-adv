<?php

namespace bikes;


use Bike;

class Detail {

    public function render(DetailViewModel $model) {
        echo '
        <h2>' . $model->bike->name . '</h2>
        <p> Categorie: ' . $model->bike->category . '</p>
        <p>' . $model->bike->description . '</p>
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6">
        
        <p><img src="' . $model->bike->image . '" class="img-responsive img-thumbnail"></p>
        
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <p>Price : ' . $model->bike->price . '</p>
        <p><a href="#" data-id="' . $model->bike->id . '" class="btn btn-success shop-item-button">
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Add to cart
        </a></p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> Gratis afhaling</p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> Gratis levering</p>
        <p><span class="glyphicon glyphicon-ok" style="color:green;"></span> 30 dagen bedenktijd</p>
    </div>
</div>';
        if (count($model->sameCategory) > 0) {
            echo '<h3>Here\'s a selection from the same category</h3>';

            Bike::renderBikes($model->sameCategory);
        }
    }
}