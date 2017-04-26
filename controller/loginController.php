<?php

require_once ("controller.php");

require_once (SERVICE_PATH . "/userRepository.php");
require_once(VIEW_PATH . "/login/index.php");
require_once(VIEW_PATH . "/login/register.php");

class LoginController implements Controller {
    private $users;

    function __construct(UserRepository $users) {
        $this->users = $users;
    }

    public function index() {
        if ($this->users->isUserLoggedIn()) {
            $this->redirectToHome();
        } else {
            return new Index();
        }
    }
    public function register() {
        if ($this->users->isUserLoggedIn()) {
            $this->redirectToHome();
        } else {
            return new Register();
        }
    }
    private function redirectToHome() {
        header('Location: ' . SITE_ROOT . '/');
        die(0);
    }
}