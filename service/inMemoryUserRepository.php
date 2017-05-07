<?php

require_once("userRepository.php");

class InMemoryUserRepository implements UserRepository {
    const SessionKey = "login";
    const OneYear = 60*60*24*365;

    function isUserLoggedIn() {
        if ($this->hasCookieValue(InMemoryUserRepository::SessionKey, "123")) {
            return true;
        }
        if ($this->hasSessionValue(InMemoryUserRepository::SessionKey, "456")) {
            return true;
        }
        return false;
    }

    private function hasCookieValue($key, $value) {
        return isset($_COOKIE[$key]) && !empty($_COOKIE[$key]) && $_COOKIE[$key] === $value;
    }

    private function hasSessionValue($key, $value) {
        $this->initializeSession();
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]) && $_SESSION[$key] === $value;
    }

    function tryLogin($user, $pass, $keep) {
        if ($user === "admin" && $pass === "adm1n") {
            if ($keep) {
                $this->setCookieValue(InMemoryUserRepository::SessionKey, "123");
            } else {
                $this->setSessionValue(InMemoryUserRepository::SessionKey, "456");
            }
            return true;
        }
        return false;
    }

    private function setCookieValue($key, $value) {
        setcookie($key, $value, time()+InMemoryUserRepository::OneYear, SITE_ROOT);
    }

    private function setSessionValue($key, $value) {
        $this->initializeSession();
        $_SESSION[$key] = $value;
    }

    private function initializeSession() {
        if(!isset($_SESSION)) {
            session_start();
        }
    }

    function logout() {
        $this->unsetCookie(InMemoryUserRepository::SessionKey);
        $this->unsetSession(InMemoryUserRepository::SessionKey);
    }

    private function unsetCookie($key) {
        unset($_COOKIE[$key]);
        setcookie($key, '', time()-InMemoryUserRepository::OneYear, SITE_ROOT);
    }

    private function unsetSession($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}