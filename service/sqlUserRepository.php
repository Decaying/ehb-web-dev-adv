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
        $is_admin = $user->isAdmin() ? 1 : 0;
        $sql = "INSERT INTO User (firstname, lastname, email, password, salt, is_admin) VALUES ('$firstname','$lastname','$email','$password','$salt',$is_admin)";
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
        $email = $this->context->escape_string($user);
        $sql = "SELECT id, firstname, lastname, email, password, salt, is_admin FROM User WHERE email = '$email'";
        $result = $this->context->executeOne($sql);
        if ($result){
            $row = $result->fetch_row();
            $id = $row[0];
            $firstname = $row[1];
            $lastname = $row[2];
            $email = $row[3];
            $password = $row[4];
            $salt = $row[5];
            $isAdmin = $row[6] == 1 ? true : false;
            return new User($firstname, $lastname, $email, $password, $isAdmin, $id, $salt);
        }
        return null;
    }
}