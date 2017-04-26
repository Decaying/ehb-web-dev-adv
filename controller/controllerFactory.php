<?php

class ControllerFactory {

    public function getController($controllerName) {
        $controller = null;

        if ($controllerName === "search") {
            require_once("searchResultsController.php");
            $controller = new SearchResultsController($this->getBikeRepository());
        } else if ($controllerName === "home") {
            require_once("homeController.php");
            $controller = new HomeController($this->getBikeRepository());
        } else if ($controllerName === "bikes") {
            require_once("bikesController.php");
            $controller = new BikesController($this->getBikeRepository());
        } else if ($controllerName === "api") {
            require_once("purchaseController.php");
            $controller = new PurchaseController($this->getBikeRepository(), $this->getPurchaseRepository());
        }

        return $controller;
    }

    private function getBikeRepository() {
        require_once(SERVICE_PATH . "/inMemoryCustomBikeRepository.php");
        return new InMemoryCustomBikeRepository();
    }

    private function getPurchaseRepository() {
        require_once(SERVICE_PATH . "/sessionPurchaseRepository.php");
        return new SessionPurchaseRepository();
    }

}