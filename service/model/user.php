<?php

class User {
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $salt;
    private $isAdmin;

    function __construct($firstname, $lastname, $email, $password, $isAdmin = false) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $this->encrypt($password);
        $this->isAdmin = $isAdmin;
    }

    private function encrypt($password) {
        if (!isset($this->salt))
            $this->salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        return crypt($password, $this->salt);
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function validatePassword($pass) {
        return $this->password === $this->encrypt($pass);
    }
}