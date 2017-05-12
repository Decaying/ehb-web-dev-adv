<?php

require_once("model/user.php");

interface UserRepository {
    function userExists($email);

    function addUser(User $user);

    function validateUserPassword($user, $pass);


    /**
     * @param $user - the user id
     * @return User
     */
    function getUser($user);
}