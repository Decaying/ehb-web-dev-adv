<?php
require_once("config.php");

$page = isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : "home";
$action = isset($_GET['a']) && !empty($_GET['a']) ? $_GET['a'] : "index";

if (isset($_GET['id']) && !empty($_GET['id'])) $param = $_GET['id'];
if (isset($_GET["q"])) $param = $_GET["q"];

require_once(SERVICE_PATH . "/inMemoryCustomBikeRepository.php");
$customBikes = new InMemoryCustomBikeRepository();

require_once(SERVICE_PATH . "/sessionPurchaseRepository.php");
$purchases = new SessionPurchaseRepository();

if ($page === "search") {
    require_once("controller/searchResultsController.php");
    $controller = new SearchResultsController($customBikes);
} else if ($page === "home") {
    require_once("controller/homeController.php");
    $controller = new HomeController($customBikes);
} else if ($page === "bikes") {
    require_once("controller/bikesController.php");
    $controller = new BikesController($customBikes);
} else if ($page === "api") {
    register_shutdown_function(function() use($action, $page){
        if (error_get_last() !== NULL) {
            header('X-PHP-Response-Code: 404', true, 404);
            throw new Exception("action '" . $action . "'' not mapped to controller '" . $page . "'.");
        }
    });

    require_once("controller/apiController.php");
    $controller = new ApiController($customBikes, $purchases);
    if (isset($param)){
        $controller->$action($param);
    } else {
        $controller->$action();
    }
    die(0);
} else {
    header('X-PHP-Response-Code: 404', true, 404);
    throw new Exception("action '".$action."'' not mapped to controller '".$page."'.");
}

require_once("header.php");
?>
    <div class="container">
        <?php
            if (isset($param)){
                $controller->$action($param);
            } else {
                $controller->$action();
            }
        ?>
    </div>
<?php
require_once("footer.php");
?>