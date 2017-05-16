<?php

interface LoginTokenRepository {
    /**
     * @param $user
     * @return string the token to validate the login session
     */
    function addSession($user);

    /**
     * @param $user
     * @param $token
     * @return bool
     */
    function isTokenValid($user, $token);
}