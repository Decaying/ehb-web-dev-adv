<?php

use contact\Index;

require_once("controller.php");
require_once(VIEW_PATH . "/contact/index.php");

class ContactController extends Controller {
    private $users;

    function __construct(UserRepository $users) {
        $this->users = $users;
    }

    public function index() {
        if ($this->users->isUserLoggedIn())
            return new Index();
        else
            $this->redirectToLogin();
    }

    public function send() {
        if ($_POST["form-id"] === "contact") {
            echo $_POST["remarks"];
            die();
        }
        $this->redirectToHome();
    }
}