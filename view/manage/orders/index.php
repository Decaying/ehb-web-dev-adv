<?php

namespace manage\orders;

use View;

require_once(VIEW_PATH . "/view.php");

class Index implements View {

    function render() {
        echo "overview of the orders";
    }
}