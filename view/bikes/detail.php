<?php

namespace bikes;

require_once(VIEW_PATH . "/view.php");
require_once(VIEW_PATH . "/bike.php");
require_once(SERVICE_PATH . "/authenticationManager.php");

use Bike;
use View;

class Detail implements View {
    private $model;

    function __construct(DetailViewModel $model) {
        $this->model = $model;
    }

    public function render() {
        $root = SITE_ROOT;
        $bike = $this->model->bike;
        $name = $bike->name;
        $category = $bike->name;
        $description = $bike->description;
        $image = $bike->image;
        $price = $bike->getPriceWithCurrency();
        $id = $bike->id;

        echo "
<script src='$root/js/bikes_detail.js' lang='javascript'></script>
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
        </a></p>";
        $avgRating = $this->model->getAvgRating();
        if ($avgRating > 0) {
            echo "Average rating: <ul class='rating'>";
            for ($i = 0; $i < 5; $i++) {
                $icon = $avgRating > $i ? "glyphicon-star" : "glyphicon-star-empty";
                echo "<li><span class='glyphicon $icon'></span></li>";
            }
            echo "</ul>";
        } else {
            echo "This bike has not been rated yet.";
        }

        echo "<p><span class='glyphicon glyphicon-ok' style='color:green;'></span> Gratis afhaling</p>
        <p><span class='glyphicon glyphicon-ok' style='color:green;'></span> Gratis levering</p>
        <p><span class='glyphicon glyphicon-ok' style='color:green;'></span> 30 dagen bedenktijd</p>
    </div>
</div>";
        if (count($this->model->sameCategory) > 0) {
            echo "<h3>Here's a selection from the same category</h3>";

            Bike::renderBikes($this->model->sameCategory);
        }

        if ($this->model->isUserLoggedIn()){
            $userRating = $this->model->getUserRating();
            if ($userRating){
                echo "Your rating: <ul class='rating'>";
                for ($i = 0; $i < 5; $i++) {
                    $icon = $userRating > $i ? "glyphicon-star" : "glyphicon-star-empty";
                    echo "<li><span class='glyphicon $icon'></span></li>";
                }
                echo "</ul>";
            } else {
                echo "Submit your rating: 
<ul class='rating'>
    <a class='rating-link' href=''><li id='rating-item-1' data-rating='1'><span class='glyphicon glyphicon-star-empty'></span></li></a>
    <a class='rating-link' href=''><li id='rating-item-2' data-rating='2'><span class='glyphicon glyphicon-star-empty'></span></li></a>
    <a class='rating-link' href=''><li id='rating-item-3' data-rating='3'><span class='glyphicon glyphicon-star-empty'></span></li></a>
    <a class='rating-link' href=''><li id='rating-item-4' data-rating='4'><span class='glyphicon glyphicon-star-empty'></span></li></a>
    <a class='rating-link' href=''><li id='rating-item-5' data-rating='5'><span class='glyphicon glyphicon-star-empty'></span></li></a>
</ul>";
            }
        } else {
            echo "<p>You need to be logged in to rate the bikes.</p>";
        }
    }
}