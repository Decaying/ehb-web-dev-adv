<?php

interface UserRepository {
    function isUserLoggedIn();

    function tryLogin($user, $pass, $keep);
    function logout();
}