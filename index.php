<?php
require_once("config.php");

$controllerName = isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : "home";
$viewName = isset($_GET['a']) && !empty($_GET['a']) ? $_GET['a'] : "index";

$param = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : null;
$param = (isset($_GET["q"]) && !empty($_GET['q'])) ? $_GET["q"] : $param;


require_once(SERVICE_PATH . "/serviceFactory.php");
$serviceFactory = new ServiceFactory();

require_once("controller/controllerFactory.php");
$controllerFactory = new ControllerFactory($serviceFactory);
$controller = $controllerFactory->getController($controllerName);

if ($controller === null) {
    header('X-PHP-Response-Code: 404', true, 404);
    throw new Exception("Controller '".$controllerName."' does not exist.");
}

if (!method_exists($controller, $viewName)){
    header('X-PHP-Response-Code: 404', true, 404);
    throw new Exception("action '".$viewName."'' not mapped to controller '".$controllerName."'.");
}

if ($controller instanceof ApiController) {
    renderContent($controller, $viewName, $param);
} else if ($controller instanceof Controller) {
    require_once("header.php");

    echo '<div class="container">';
    renderContent($controller, $viewName, $param);
    echo '</div>';

    require_once("footer.php");
} else {
    header('X-PHP-Response-Code: 500', true, 500);
    throw new Exception("Controller '".$controllerName."' has not been implemented correctly.");
}

function renderContent($controller, $viewName, $param){
    $view = callController($controller, $viewName, $param);

    if (isset($view)) {
        renderView($view);
    } else {
        header('X-PHP-Response-Code: 500', true, 500);
        throw new Exception("Controller '" . get_class($controller) . "' with action '" . $viewName . "' has not been implemented correctly.");
    }
}

function callController($controller, $viewName, $param) {
    if ($param !== null){
        return $controller->$viewName($param);
    } else {
        return $controller->$viewName();
    }
}

function renderView($view) {
    if ($view instanceof View)
        $view->render();
    else
        echo $view;
}