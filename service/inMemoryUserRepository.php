<?php

require_once("model/user.php");

class InMemoryUserRepository implements UserRepository {

    private $registeredUsers;

    function __construct() {
        $adminUser = new User("Hans", "Buys", "hans.buys@student.ehb.be", "adm1n", true, 1);

        $this->registeredUsers = array(
            $adminUser->getEmail() => $adminUser
        );
    }

    function userExists($email) {
        return array_key_exists($email, $this->registeredUsers);
    }

    function addUser(User $user) {
        $this->registeredUsers[$user->getEmail()] = $user;
    }

    function getUser($user) {
        if ($this->userExists($user))
            return $this->registeredUsers[$user];
        return null;
    }

    function validateUserPassword($user, $pass) {
        $user = $this->getUser($user);
        return $user->validatePassword($pass);
    }
}