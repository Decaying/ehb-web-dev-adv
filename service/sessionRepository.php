<?php

interface SessionRepository {
    function addSession($user, $keep);
    function isTokenValid($user, $token);
}