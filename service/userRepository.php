<?php

require_once("model/user.php");

interface UserRepository {
    /**
     * @param $email
     * @return bool
     */
    function userExists($email);

    /**
     * @param User $user
     * @return void
     */
    function addUser(User $user);

    /**
     * @param $user
     * @param $pass
     * @return bool
     */
    function validateUserPassword($user, $pass);


    /**
     * @param $user - the user id
     * @return User
     */
    function getUser($user);
}