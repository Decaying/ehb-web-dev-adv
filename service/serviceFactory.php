<?php

class ServiceFactory {
    public function getCustomBikeRepository() {
        require_once("inMemoryCustomBikeRepository.php");
        return new InMemoryCustomBikeRepository();
    }

    public function getSessionPurchaseManager() {
        require_once("sessionPurchaseManager.php");
        return new SessionPurchaseManager();
    }

    public function getSessionManager() {
        require_once("sessionManager.php");
        return new SessionManager($this->getUserRepository());
    }

    public function getUserRepository() {
        require_once("inMemoryUserRepository.php");
        return new InMemoryUserRepository();
    }
}