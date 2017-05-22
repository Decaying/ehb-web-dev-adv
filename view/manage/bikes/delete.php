<?php

namespace manage\bikes;

use View;

require_once(VIEW_PATH . "/view.php");

class Delete implements View {

    function render() {
        $root = SITE_ROOT;
        echo "
<div style='text-align: center'>
    <h3>Are you sure you want to delete this bike?</h3>
    <form action='' method='post'>
    <input type='hidden' name='form-id' value='confirm-delete'>
    <input type='submit' class='btn btn-danger' value='Confirm'>
    <a href='$root/manage' class='btn btn-primary'>Cancel</a>
    </form>
</div>";
    }
}