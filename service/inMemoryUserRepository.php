<?php

require_once("userRepository.php");

class InMemoryUserRepository implements UserRepository {
    function isUserLoggedIn() {
        return false;
    }
}