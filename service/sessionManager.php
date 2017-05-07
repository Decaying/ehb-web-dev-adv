<?php

require_once(SERVICE_PATH . "/userRepository.php");
require_once(SERVICE_PATH . "/sessionRepository.php");

class SessionManager {
    const SessionKey = "login";
    const LoggedInUserKey = "user";
    const OneYear = 60*60*24*365;

    private $users;
    private $sessions;

    function __construct(UserRepository $users, SessionRepository $sessions) {
        $this->users = $users;
        $this->sessions = $sessions;
    }

    public function isUserLoggedIn() {
        $user = $this->getCurrentUser();
        if ($user === "")
            return false;
        
        $token = $this->getToken();

        if ($token !== "" && $this->sessions->isTokenValid($user, $token)) {
            return true;
        }
        return false;
    }

    public function getCurrentUser() {
        return $this->getCookieValue(SessionManager::LoggedInUserKey);
    }

    private function getSessionValue($key) {
        $this->initializeSession();
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return "";
    }

    private function getCookieValue($key) {
        if (isset($_COOKIE[$key]) && !empty($_COOKIE[$key]))
            return $_COOKIE[$key];
        else
            return "";
    }

    public function tryLogin($user, $pass, $keep) {
        if ($this->users->userExists($user) && $this->users->validateUserPassword($user, $pass)) {
            $this->setCookieValue(SessionManager::LoggedInUserKey, $user);

            $token = $this->sessions->addSession($user, $keep);
            $this->setToken($keep, $token);
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

    public function logout() {
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

    public function register($email, $pass) {
        if (!$this->users->userExists($email)) {
            $this->users->addUser($email, $pass);
            return true;
        } else {
            return "User already exists.";
        }
    }

    public function getUserEmail() {
        if ($this->isUserLoggedIn())
            return $this->getCurrentUser();
        return false;
    }

    private function getToken() {
        $cookieToken = $this->getCookieValue(SessionManager::SessionKey);
        if ($cookieToken !== "")
            return $cookieToken;

        $sessionToken = $this->getSessionValue(SessionManager::SessionKey);
        if ($sessionToken !== "")
            return $sessionToken;

        return "";
    }

    private function setToken( $keep, $token) {
        if ($keep) {
            $this->setCookieValue(SessionManager::SessionKey, $token);
        } else {
            $this->setSessionValue(SessionManager::SessionKey, $token);
        }
    }
}