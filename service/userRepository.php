<?php

interface UserRepository {
    function userExists($email);

    function addUser($firstname, $lastname, $email, $pass);

    function validateUserPassword($user, $pass);
}