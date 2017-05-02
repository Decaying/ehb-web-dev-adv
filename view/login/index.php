<?php

require_once(VIEW_PATH . "/view.php");

class Index implements View {
    private $message;

    function __construct($message = null) {
        $this->message = $message;
    }

    function render() {
        echo '
<h3>Login</h3>';

        if (!!$this->message) {
            echo '
<div class="panel panel-danger">
    <div class="panel-heading">' . $this->message . '</div>
</div>';
        }

echo '        
<form action="' . SITE_ROOT . '/login" method="POST">
    <div class="row">
        <label class="col-lg-1 col-md-1" for="user">User: </label>
        <div class="col-lg-11 col-md-11">
            <input class="form-control" type="text" name="user" id="user">
        </div>
    </div>
    <div class="row">
        <label class="col-lg-1 col-md-1" for="pass">Password: </label>
        <div class="col-lg-11 col-md-11">
            <input class="form-control" type="password" name="pass" id="pass">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <input type="checkbox" id="keep" name="keep">
            <label for="pass">Stay logged in? </label>
        </div>
    </div>
    <input id="submit" type="submit" value="Login">
</form>
        ';
    }
}