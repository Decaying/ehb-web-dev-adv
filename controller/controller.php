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
}