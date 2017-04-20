<?php
require_once("res/config.php");

$page = isset($_GET['p']) && !empty($_GET['p']) ? $_GET['p'] : "home";
$action = isset($_GET['a']) && !empty($_GET['a']) ? $_GET['a'] : "index";

if ($page === "about") {
    require_once("controller/aboutController.php");
    $controller = new AboutController();
} else if ($page === "search") {
    require_once("controller/searchResultsController.php");
    $controller = new SearchResultsController();
} else if ($page === "home") {
    require_once("controller/homeController.php");
    $controller = new HomeController();
} else {
    throw new Exception("action ".$action." not found on controller ".$page);
}

require_once("header.php");
?>
    <div class="container">
        <?php
            $controller->$action();
        ?>
    </div>
<?php
require_once("footer.php");
?>