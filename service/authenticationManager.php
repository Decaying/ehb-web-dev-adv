<?php

require_once(SERVICE_PATH . "/userRepository.php");
require_once(SERVICE_PATH . "/loginTokenRepository.php");
require_once(SERVICE_PATH . "/model/user.php");

class AuthenticationManager {
    const SessionKey = "login";
    const LoggedInUserKey = "user";
    const OneYear = 60*60*24*365;

    private $users;
    private $sessions;

    function __construct(UserRepository $users, LoginTokenRepository $sessions) {
        $this->users = $users;
        $this->sessions = $sessions;
    }

    public function isUserLoggedIn() {
        $user = $this->getCurrentUser();
        if ($user === "")
            return false;
        
        return $this->validateToken($user);
    }

    public function getCurrentUser() {
        return $this->getCookieValue(AuthenticationManager::LoggedInUserKey);
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
            $this->setCookieValue(AuthenticationManager::LoggedInUserKey, $user);

            $token = $this->sessions->addSession($user);
            $this->setToken($keep, $token);
            return true;
        }
        return false;
    }

    private function setCookieValue($key, $value) {
        setcookie($key, $value, time()+AuthenticationManager::OneYear, SITE_ROOT);
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
        $this->unsetCookie(AuthenticationManager::SessionKey);
        $this->unsetSession(AuthenticationManager::SessionKey);
    }

    private function unsetCookie($key) {
        unset($_COOKIE[$key]);
        setcookie($key, '', time()-AuthenticationManager::OneYear, SITE_ROOT);
    }

    private function unsetSession($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function register($firstname, $lastname, $email, $pass) {
        if (!$this->users->userExists($email)) {
            $this->users->addUser(new User($firstname, $lastname, $email, $pass));
            return true;
        } else {
            return "User already exists.";
        }
    }

    /**
     * @return User
     */
    public function getUser() {
        if ($this->isUserLoggedIn())
            $user = $this->users->getUser($this->getCurrentUser());
            if (isset($user) && $user !== null)
                return $user;

        return null;
    }

    private function validateToken($user) {
        $token = $this->getCookieValue(AuthenticationManager::SessionKey);
        if (!$token){
            $token = $this->getSessionValue(AuthenticationManager::SessionKey);
        }

        if (!!$token) {
            return $this->sessions->isTokenValid($user, $token);
        }

        return "";
    }

    private function setToken( $keep, $token) {
        if ($keep) {
            $this->setCookieValue(AuthenticationManager::SessionKey, $token);
        } else {
            $this->setSessionValue(AuthenticationManager::SessionKey, $token);
        }
    }
}