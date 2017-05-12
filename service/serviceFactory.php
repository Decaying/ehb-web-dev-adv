<?php

class ServiceFactory {
    public function getCustomBikeRepository() {
        require_once("inMemoryCustomBikeRepository.php");
        return new InMemoryCustomBikeRepository();
    }

    public function getSessionCartManager() {
        require_once("sessionCartManager.php");
        return new SessionCartManager();
    }

    public function getAuthenticationManager() {
        require_once("authenticationManager.php");
        return new AuthenticationManager($this->getUserRepository(), $this->getLoginTokenRepository());
    }

    public function getLoginTokenRepository() {
        require_once("inMemoryLoginTokenRepository.php");
        return new InMemoryLoginTokenRepository();
    }

    public function getUserRepository() {
        require_once("inMemoryUserRepository.php");
        return new InMemoryUserRepository();
    }

    public function getMailer() {
        require_once("mailer.php");
        return new Mailer();
    }
}