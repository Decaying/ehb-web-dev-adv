<?php

namespace manage\bikes;

require_once(VIEW_PATH . "/view.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");

use CustomBikeViewModel;
use View;

class Index implements View {

    private $bikes;

    function __construct(array $bikes) {
        $this->bikes = $bikes;
    }

    function render() {
        $root = SITE_ROOT;
        echo '<h3>Manage your bikes</h3>';

        echo "<a href='$root/manage/create' class='btn btn-success new-bike'><span class='glyphicon glyphicon-plus'></span> Create</a>";

        echo "<div class='container' style='margin-top: 10px;'>";
        foreach ($this->bikes as $key => $bike){
            echo '<div class="row">';
            $this->renderBike($bike);
            echo '</div>';
        }
        echo "</div>";
    }

    private function renderBike(CustomBikeViewModel $bike) {
        $root = SITE_ROOT;
        $highlight_text = $bike->isHighlighted ? "Yes" : "No";
        $price = $bike->getPriceWithCurrency();

        echo "
<div class='panel panel-success'>
    <div class='panel-heading'>
        <h4>$bike->name</h4>
    </div>
    <div class='panel-body row'>
        <div class='col-md-2'>
            <img src='$bike->image' style='max-width: 150px;' class='img-responsive img-thumbnail'>
        </div>
        <div class='col-md-10'>
            <p>Category: $bike->category</p>
            <p>Description: $bike->description</p>
            <p>Price: $price</p>
            <p>Display in highlights: $highlight_text</p>
            <div class='pull-right'>
                <a href='$root/manage/edit/$bike->id' class='btn btn-primary'><span class='glyphicon glyphicon-cog'></span> Edit</a>
                <a href='$root/manage/delete/$bike->id' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Delete</a>
            </div>
        </div>
    </div>
</div>
";
    }
}