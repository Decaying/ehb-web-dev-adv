<?php

interface UserRepository {
    function userExists($email);

    function addUser($email, $pass);

    function validateUserPassword($user, $pass);
}