<?php

require_once("view.php");

class NotAuthorized implements View {

    function render() {
        header('X-PHP-Response-Code: 401', true, 401);
        throw new Exception("You are not authorized to use this page");
    }
}