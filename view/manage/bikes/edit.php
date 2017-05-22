<?php

namespace manage\bikes;

use CustomBikeViewModel;
use View;

require_once(VIEW_PATH . "/view.php");
require_once(MODEL_PATH . "/customBikeViewModel.php");

class Edit implements View {

    private $bike;

    function __construct(CustomBikeViewModel $bike) {
        $this->bike = $bike;
    }

    function render() {
        $root = SITE_ROOT;
        $name = $this->bike->name;
        $category = $this->bike->category;
        $price = $this->bike->getPrice();
        $description = $this->bike->description;
        $image = $this->bike->image;
        $isHighlighted = $this->bike->isHighlighted ? 'checked' : '';
        echo "
<script src='$root/js/validations.js' lang='javascript'></script>
<script src='$root/js/edit_bike.js' lang='javascript'></script>
<h3>Edit</h3>
<form action='' method='post'>
    <input type='hidden' name='form-id' value='edit-bike'>
    
    <div class='form-group'>
        <label for='name'>Name</label>
        <input class='form-control' type='text' name='name' id='name' placeholder='What shall we name the beast?' value='$name'>
    </div>
    
    <div class='form-group'>
        <label for='category'>Category</label>
        <input class='form-control' type='text' name='category' id='category' placeholder='How do we categorize it?' value='$category'>
    </div>
    
    <div class='form-group'>
        <label for='price'>Price</label>
        <input class='form-control' type='number' step='any' name='price' id='price' placeholder='Name your price' value='$price'>
    </div>
    
    <div class='form-group'>
        <label for='description'>Description</label>
        <textarea class='form-control' name='description' id='description' placeholder='Put its description here'>$description</textarea>
    </div>
    
    <div class='form-group'>
        <label for='image'>Image</label>
        <input class='form-control' type='url' name='image' id='image' placeholder='What does it look like?' value='$image'>
    </div>
    
    <div class='form-group'>
        <label>
            <input type='checkbox' name='is-highlighted' id='is-highlighted' $isHighlighted>
            Do you want it highlighted?
        </label>
    </div>
    
    <div class='pull-right form-group'>
        <input type='submit' value='Update' class='btn btn-success'>
    </div>
</form>
        ";
    }
}