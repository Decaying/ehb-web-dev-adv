<?php

namespace cart;

use View;

require_once(VIEW_PATH . "/view.php");

class LoginOrRegisterFirst implements View {

    function render() {
        echo '
<h3>Please login or register first.</h3>
<p>Click <a href="' . SITE_ROOT . '/login?redirect=/cart/checkout">here</a> for logging in.</p>
';
    }
}