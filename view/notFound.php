<?php

require_once("view.php");

class NotFound implements View {
    public $message;

    function __construct($message) {
        $this->message = $message;
    }

    function render() {
        header('X-PHP-Response-Code: 404', true, 404);
        throw new Exception($this->message);
    }
}