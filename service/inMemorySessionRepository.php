<?php

class InMemorySessionRepository implements SessionRepository {

    function __construct() {
        $this->initializeSession();
    }

    private function initializeSession() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    function addSession($user, $keep) {
        $token = $user . "123";
        $_SESSION["token-for-" . $user] = $token;
        return $token;
    }

    function isTokenValid($user, $token) {
        return isset($_SESSION["token-for-" . $user]) && $_SESSION["token-for-" . $user] === $token;
    }
}