<?php

require_once(SERVICE_PATH . "/userRepository.php");

class SessionManager {
    const SessionKey = "login";
    const SessionLoggedInUserKey = "user";
    const OneYear = 60*60*24*365;

    private $userRepository;

    function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    function isUserLoggedIn() {
        $user = $this->getSessionValue(SessionManager::SessionLoggedInUserKey);
        if ($user === "")
            return false;

        if ($this->hasCookieValue(SessionManager::SessionKey, $user . "123")) {
            return true;
        }
        if ($this->hasSessionValue(SessionManager::SessionKey, $user . "456")) {
            return true;
        }
        return false;
    }

    private function getSessionValue($key) {
        $this->initializeSession();
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return "";
    }

    private function hasCookieValue($key, $value) {
        return isset($_COOKIE[$key]) && !empty($_COOKIE[$key]) && $_COOKIE[$key] === $value;
    }

    private function hasSessionValue($key, $value) {
        return $this->getSessionValue($key) === $value;
    }

    function tryLogin($user, $pass, $keep) {
        if ($this->userRepository->userExists($user) && $this->userRepository->validateUserPassword($user, $pass)) {
            if ($keep) {
                $this->setCookieValue(SessionManager::SessionKey, $user . "123");
            } else {
                $this->setSessionValue(SessionManager::SessionKey, $user . "456");
            }

            $this->setSessionValue(SessionManager::SessionLoggedInUserKey, $user);
            return true;
        }
        return false;
    }

    private function setCookieValue($key, $value) {
        setcookie($key, $value, time()+SessionManager::OneYear, SITE_ROOT);
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
        $this->unsetCookie(SessionManager::SessionKey);
        $this->unsetSession(SessionManager::SessionKey);
    }

    private function unsetCookie($key) {
        unset($_COOKIE[$key]);
        setcookie($key, '', time()-SessionManager::OneYear, SITE_ROOT);
    }

    private function unsetSession($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    function register($email, $pass) {
        if (!$this->userRepository->userExists($email)) {
            $this->userRepository->addUser($email, $pass);
            return true;
        } else {
            return "User already exists.";
        }
    }
}