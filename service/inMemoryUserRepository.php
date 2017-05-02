<?php

require_once("userRepository.php");

class InMemoryUserRepository implements UserRepository {
    const SessionKey = "login";

    function isUserLoggedIn() {
        if ($this->hasCookie(InMemoryUserRepository::SessionKey) && $_COOKIE[InMemoryUserRepository::SessionKey] === "123")
            return true;
        if ($this->hasSession(InMemoryUserRepository::SessionKey) && $_SESSION[InMemoryUserRepository::SessionKey] === "456")
            return true;
        return false;
    }

    function tryLogin($user, $pass, $keep) {
        if ($user === "admin" && $pass === "adm1n") {
            if ($keep) {
                setcookie(InMemoryUserRepository::SessionKey, "123");
            } else {
                session_start();
                $_SESSION[InMemoryUserRepository::SessionKey] = "456";
            }
            return true;
        }
        return false;
    }

    private function hasCookie($key) {
        return isset($_COOKIE[$key]) && !empty($_COOKIE[$key]);
    }

    private function unsetCookie($key) {
        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
            setcookie($key, '', time() - 3600);
        }
    }

    private function hasSession($key) {
        session_start();
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }

    private function unsetSession($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    function logout() {
        $this->unsetCookie(InMemoryUserRepository::SessionKey);
        $this->unsetSession(InMemoryUserRepository::SessionKey);
    }
}