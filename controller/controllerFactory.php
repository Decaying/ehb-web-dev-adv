<?php

class ControllerFactory {
    private $factory;

    function __construct() {
        $this->factory = new ServiceFactory();
    }

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
        } else if ($controllerName === "basket") {
            require_once("basketController.php");
            $controller = new BasketController($this->getBikeRepository(), $this->getPurchaseRepository());
        }else if ($controllerName === "login") {
            require_once("loginController.php");
            $controller = new LoginController($this->getUserRepository());
        }

        return $controller;
    }

    private function getBikeRepository() {
        return $this->factory->getCustomBikeRepository();
    }

    private function getPurchaseRepository() {
        return $this->factory->getPurchaseRepository();
    }

    private function getUserRepository() {
        return $this->factory->getUserRepository();
    }
}