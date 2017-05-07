<?php

use login\Index;
use login\Register;

require_once("controller.php");

require_once(SERVICE_PATH . "/userRepository.php");
require_once(VIEW_PATH . "/login/index.php");
require_once(VIEW_PATH . "/login/register.php");

class LoginController extends Controller {
    private $users;

    function __construct(UserRepository $users) {
        $this->users = $users;
    }

    public function index() {
        if ($this->users->isUserLoggedIn()) {
            $this->redirectToHome();
        } else {
            return $this->doLogin();
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
            return new Register();
        }
    }

    private function doLogin() {
        if ($this->hasValue("user") && $this->hasValue("pass")) {
            $keep = $this->hasValue("keep");
            if ($this->users->tryLogin($_POST["user"], $_POST["pass"], $keep)) {
                $this->redirectToHome();
            } else {
                return new Index("Unable to login");
            }
        } else {
            return new Index();
        }
    }

    private function hasValue($key) {
        return isset($_POST[$key]) && !empty($_POST[$key]);
    }
}