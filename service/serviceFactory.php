<?php

class ServiceFactory {
    public function getCustomBikeRepository() {
        require_once("sqlCustomBikeRepository.php");
        return new SqlCustomBikeRepository($this->getSqlContext(), $this->getLog());
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
        require_once("sqlLoginTokenRepository.php");
        return new SqlLoginTokenRepository($this->getSqlContext());
    }

    public function getUserRepository() {
        require_once("sqlUserRepository.php");
        return new SqlUserRepository($this->getSqlContext());
    }

    public function getMailer() {
        require_once("mailer.php");
        return new Mailer();
    }

    public function getOrderRepository() {
        require_once("sqlOrderRepository.php");
        return new SqlOrderRepository($this->getSqlContext());
    }

    public function getSqlContext() {
        require_once("sqlContext.php");
        return new SqlContext($this->getLog());
    }

    public function getLog() {
        require_once("browserLog.php");
        return new BrowserLog();
    }

    public function getRatingsRepository() {
        require_once("sqlRatingsRepository.php");
        return new SqlRatingsRepository($this->getSqlContext());
    }
}