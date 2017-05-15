<?php

interface LoginTokenRepository {
    function addSession($user);
    function isTokenValid($user, $token);
}