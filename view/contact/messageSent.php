<?php

namespace contact;

use View;

require_once(VIEW_PATH . "/view.php");

class MessageSent implements View {
    function render() {
        echo '
<h3>Thank you</h3>
<p>Your message has been sent to the administators and will be handled as soon as possible.</p>';
    }
}