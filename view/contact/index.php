<?php

namespace contact;

use View;

require_once(VIEW_PATH . "/view.php");

class Index implements View {
    function render() {
        echo '
<h3>Contact</h3>

<form action="' . SITE_ROOT . '/contact/send" method="post">
    <input type="hidden" name="form-id" value="contact" />
    <div class="row">
        <label for="remarks" class="col-md-12">Remarks</label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <textarea name="remarks" id="remarks" class="form-control" placeholder="What can we help you with?" style="resize:vertical"></textarea>
        </div>
    </div>
    <input id="submit" type="submit" value="Send" class="pull-right">
</form>';
    }
}