<?php

interface LoginTokenRepository {
    function addSession($user, $keep);
    function isTokenValid($user, $token);
}