<?php

abstract class Controller {

    protected function redirectToHome() {
        header('Location: ' . SITE_ROOT . '/');
        exit;
    }

    protected function redirectToLogin() {
        header('Location: ' . SITE_ROOT . '/login');
        exit;
    }
}