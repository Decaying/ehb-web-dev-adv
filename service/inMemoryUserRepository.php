<?php

class InMemoryUserRepository implements UserRepository {

    private $registeredUsers;

    function __construct() {
        $this->registeredUsers = array(
            "admin@custombikes.be" => "adm1n"
        );
    }

    function userExists($email) {
        return array_key_exists($email, $this->registeredUsers);
    }

    function addUser($email, $pass) {
        $this->registeredUsers[$email] = $pass;
    }

    function validateUserPassword($user, $pass) {
        return $this->registeredUsers[$user] === $pass;
    }
}