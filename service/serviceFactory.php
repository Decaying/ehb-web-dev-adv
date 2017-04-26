<?php

class ServiceFactory {
    public function getCustomBikeRepository() {
        require_once("inMemoryCustomBikeRepository.php");
        return new InMemoryCustomBikeRepository();
    }

    public function getPurchaseRepository() {
        require_once("sessionPurchaseRepository.php");
        return new SessionPurchaseRepository();
    }

    public function getUserRepository() {
        require_once("inMemoryUserRepository.php");
        return new InMemoryUserRepository();
    }
}