<?php

abstract class Controller {

    protected function redirectToHome() {
        $this->redirectTo('/');
        exit;
    }

    protected function redirectToLogin() {
        $this->redirectTo('/login');
    }

    protected function redirectTo($location) {
        header('Location: ' . SITE_ROOT . $location);
        exit;
    }

    protected function hasPostValue($key) {
        return isset($_POST[$key]) && !empty($_POST[$key]);
    }

    protected function hasGetValue($key) {
        return isset($_GET[$key]) && !empty($_GET[$key]);
    }
}