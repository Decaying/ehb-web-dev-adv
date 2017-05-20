<?php

namespace login;

use View;

require_once(VIEW_PATH . "/view.php");

class Register implements View {
    private $email;
    private $message;

    function __construct($email = null, $message = null) {
        $this->email = $email;
        $this->message = $message;
    }

    function render() {
        echo '<h3>Register</h3>';

        if (!!$this->message) {
            echo '<div class="panel panel-danger">';
            echo '    <div class="panel-heading">' . $this->renderMessage($this->message) . '</div>';
            echo '</div>';
        }

echo '
<script src="' . SITE_ROOT .'/js/validations.js" lang="javascript"></script>
<script src="' . SITE_ROOT .'/js/register.js" lang="javascript"></script>

<form action="' . SITE_ROOT . '/login/register" method="POST">
    <input type="hidden" name="form-id" value="register">
    <div class="form-group">
        <label class="col-lg-2 col-md-2" for="firstname">First name: </label>
        <div class="col-lg-10 col-md-10">
            <input class="form-control" type="text" name="firstname" id="firstname">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 col-md-2" for="lastname">Last name: </label>
        <div class="col-lg-10 col-md-10">
            <input class="form-control" type="text" name="lastname" id="lastname">
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 col-md-2" for="email">Email address: </label>
        <div class="col-lg-10 col-md-10">';
            if ($this->email !== null)
                echo '<input class="form-control" type="email" name="email" id="email" value="' . $this->email . '">';
            else
                echo '<input class="form-control" type="email" name="email" id="email">';
        echo '</div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 col-md-2" for="pass">Password: </label>
        <div class="col-lg-10 col-md-10">
            <input class="form-control" type="password" name="pass" id="pass">
        </div>
        <label class="col-lg-2 col-md-2" for="pass">Repeat password: </label>
        <div class="col-lg-10 col-md-10">
            <input class="form-control" type="password" id="pass-repeat">
        </div>
    </div>
    <input id="submit" type="submit" value="Register" class="btn btn-success pull-right" disabled>
</form>
        ';
    }

    private function renderMessage($message) {
        if (is_array($message)) {
            $messages = "<ul>";
            foreach ($message as $m) {
                $messages .= "<li>" . $m . "</li>";
            }
            $messages .= "</ul>";
            return $messages;
        } else {
            return $message;
        }
    }
}