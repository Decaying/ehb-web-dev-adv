<?php

namespace manage;

use View;

require_once(VIEW_PATH . "/view.php");

class Create implements View {

    function render() {
        echo "
<h3>Create a new bike</h3>
<form action='' method='post'>
    <input type='hidden' name='form-id' value='create-bike'>
    
    <div class='form-group'>
        <label for='name'>Name</label>
        <input class='form-control' type='text' name='name' id='name' placeholder='What shall we name the beast?'>
    </div>
    
    <div class='form-group'>
        <label for='category'>Category</label>
        <input class='form-control' type='text' name='category' id='category' placeholder='How do we categorize it?'>
    </div>
    
    <div class='form-group'>
        <label for='price'>Price</label>
        <input class='form-control' type='number' step='any' name='price' id='price' placeholder='Name your price'>
    </div>
    
    <div class='form-group'>
        <label for='description'>Description</label>
        <textarea class='form-control' name='description' id='description' placeholder='Put its description here'></textarea>
    </div>
    
    <div class='form-group'>
        <label for='image'>Image</label>
        <input class='form-control' type='url' name='image' id='image' placeholder='What does it look like?'>
    </div>
    
    <div class='form-group'>
        <label>
            <input type='checkbox' name='is-highlighted' id='is-highlighted'>
            Do you want it highlighted?
        </label>
    </div>
    
    <div class='pull-right form-group'>
        <input type='submit' value='Create' class='btn btn-success'>
        <input type='reset' value='Reset' class='btn btn-alert'>
    </div>
</form>
        ";
    }
}