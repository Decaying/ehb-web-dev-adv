<?php

class ServiceFactory {
    public function getCustomBikeRepository() {
        require_once("sqlCustomBikeRepository.php");
        return new SqlCustomBikeRepository($this->getSqlContext(), $this->getLog());
        //require_once("inMemoryCustomBikeRepository.php");
        //return new InMemoryCustomBikeRepository();
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
        //require_once("inMemoryLoginTokenRepository.php");
        //return new InMemoryLoginTokenRepository();
        require_once("sqlLoginTokenRepository.php");
        return new SqlLoginTokenRepository($this->getSqlContext());
    }

    public function getUserRepository() {
        //require_once("inMemoryUserRepository.php");
        //return new InMemoryUserRepository();

        require_once("sqlUserRepository.php");
        return new SqlUserRepository($this->getSqlContext());
    }

    public function getMailer() {
        require_once("mailer.php");
        return new Mailer();
    }

    public function getSoldItemsRepository() {
        require_once("sqlSoldItemsRepository.php");
        return new SqlSoldItemsRepository($this->getSqlContext());
    }

    public function getSqlContext() {
        require_once("sqlContext.php");
        return new SqlContext($this->getLog());
    }

    public function getLog() {
        require_once("browserLog.php");
        return new BrowserLog();
    }
}