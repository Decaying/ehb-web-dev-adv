<?php

use login\Index;
use login\Register;

require_once("controller.php");

require_once(SERVICE_PATH . "/sessionManager.php");
require_once(VIEW_PATH . "/login/index.php");
require_once(VIEW_PATH . "/login/register.php");

class LoginController extends Controller {
    private $users;

    function __construct(SessionManager $users) {
        $this->users = $users;
    }

    public function index() {
        if ($this->users->isUserLoggedIn()) {
            $this->redirectToHome();
        } else {
            if ($this->hasValue("form-id") && $_POST["form-id"] === "login") {
                return $this->doLogin();
            }
            return new Index();
        }
    }

    public function logout() {
        if ($this->users->isUserLoggedIn()) {
            $this->users->logout();
        }
        $this->redirectToHome();
    }

    public function register() {
        if ($this->users->isUserLoggedIn()) {
            $this->redirectToHome();
        } else {
            if ($this->hasValue("form-id") && $_POST["form-id"] === "register") {
                return $this->doRegister();
            }
            return new Register();
        }
    }

    private function doLogin() {
        $keep = $this->hasValue("keep");
        $user = $_POST["user"];
        $pass = $_POST["pass"];

        if ($this->users->tryLogin($user, $pass, $keep)) {
            $this->redirectToHome();
        } else {
            return new Index("Unable to login");
        }
    }

    private function doRegister() {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $success = $this->users->register($email, $pass);
        if ($success !== true) {
            return new Register($email, $success);
        }

        if ($this->users->tryLogin($email, $pass, false))
            $this->redirectToHome();
        else
            $this->redirectToLogin();
    }

    private function hasValue($key) {
        return isset($_POST[$key]) && !empty($_POST[$key]);
    }
}