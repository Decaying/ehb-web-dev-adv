<?php

require_once("user.php");

class InMemoryUserRepository implements UserRepository {

    private $registeredUsers;

    function __construct() {
        $this->registeredUsers = array(
            "admin@custombikes.be" => new User("Admin", "Istrator", "admin@custombikes.be", "adm1n")
        );
    }

    function userExists($email) {
        return array_key_exists($email, $this->registeredUsers);
    }

    function addUser($firstname, $lastname, $email, $pass) {
        $this->registeredUsers[$email] = new User($firstname, $lastname, $email, $pass);
    }

    function validateUserPassword($user, $pass) {
        $user = $this->registeredUsers[$user];
        return $user->validatePassword($pass);
    }
}