<?php

require_once(SERVICE_PATH . "/serviceFactory.php");

class ControllerFactory {
    private $factory;

    function __construct(ServiceFactory $serviceFactory) {
        $this->factory = $serviceFactory;
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
            $controller = new BasketController($this->getBikeRepository(), $this->getSessionCartManager());
        } else if ($controllerName === "login") {
            require_once("loginController.php");
            $controller = new LoginController($this->getAuthenticationManager());
        } else if ($controllerName === "cart") {
            require_once("cartController.php");
            $controller = new CartController($this->getBikeRepository(), $this->getSessionCartManager(), $this->getAuthenticationManager(), $this->getSoldItemsRepository());
        } else if ($controllerName === "contact") {
            require_once("contactController.php");
            $controller = new ContactController($this->getAuthenticationManager(), $this->getMailer());
        } else if ($controllerName === "manage") {
            require_once("manageController.php");
            $controller = new ManageController($this->getBikeRepository());
        } else if ($controllerName !== "") {
            $controllerClassname = ucfirst($controllerName . "Controller");
            $controllerFilename = lcfirst($controllerClassname) . ".php";
            $controllerPath = CONTROLLER_PATH . "/" .$controllerFilename;

            if (file_exists($controllerPath)) {
                require_once($controllerPath);
                $controller = new $controllerClassname();
            }
        }

        return $controller;
    }

    private function getBikeRepository() {
        return $this->factory->getCustomBikeRepository();
    }

    private function getSessionCartManager() {
        return $this->factory->getSessionCartManager();
    }

    private function getAuthenticationManager() {
        return $this->factory->getAuthenticationManager();
    }

    private function getMailer() {
        return $this->factory->getMailer();
    }

    private function getSoldItemsRepository() {
        return $this->factory->getSoldItemsRepository();
    }
}