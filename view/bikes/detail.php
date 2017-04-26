<?php

namespace bikes;


class Detail {

    public function render(DetailViewModel $model) {
        echo '
<h1>This is the detail page for ' . $model->bike->name . ' </h1>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            ' . $model->bike->name . '
        </div>
        <div class="col-lg-4">
            <a href="#" data-id="' . $model->bike->id . '" class="btn btn-success shop-item-button pull-right">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Add to cart
            </a>
        </div>
    </div>

</div>
';
    }
}