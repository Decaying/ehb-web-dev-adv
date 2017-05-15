<?php

require_once("userRepository.php");
require_once("model/user.php");

class SqlUserRepository implements UserRepository {

    private $context;

    function __construct(SqlContext $context) {
        $this->context = $context;
    }

    function userExists($email) {
        $emailaddress = $this->context->escape_string($email);
        $sql = "SELECT count(id) FROM User WHERE email = '" . $emailaddress . "'";
        $result = $this->context->executeOne($sql);
        if ($result){
            $row = $result->fetch_row();
            return $row[0] == 1;
        }
        return false;
    }

    function addUser(User $user) {
        $firstname = $this->context->escape_string($user->getFirstname());
        $lastname = $this->context->escape_string($user->getLastname());
        $email = $this->context->escape_string($user->getEmail());
        $password = $user->getPassword();
        $salt = $user->getSalt();
        $is_admin = $user->isAdmin() ? "1" : "0";
        $sql = "INSERT INTO User (firstname, lastname, email, password, salt, is_admin) VALUES ('" . $firstname . "','" . $lastname . "','" . $email . "','" . $password . "','" . $salt . "'," . $is_admin . ")";
        $this->context->executeOne($sql);
    }

    function validateUserPassword($user, $pass) {
        $user = $this->getUser($user);
        return $user->validatePassword($pass);
    }

    /**
     * @param $user - the user id
     * @return User
     */
    function getUser($user) {
        $sql = "SELECT id, firstname, lastname, email, password, salt, is_admin FROM User WHERE email = '" . $user . "'";
        $result = $this->context->executeOne($sql);
        if ($result){
            $row = $result->fetch_row();
            return new User($row[1], $row[2], $row[3], $row[4], $row[6], $row[0], $row[5]);
        }
        return null;
    }
}