<?php

    $config = array(
        "admin" => "hans.buys@student.ehb.be",
        "db" => array (
            "hostname" => "",
            "database" => "",
            "user" => "",
            "pass" => ""
        )
    );

defined("ROOT_PATH")
    or define("ROOT_PATH", dirname(__FILE__));

defined("SITE_ROOT")
    or define("SITE_ROOT", "/~hans.buys");  // "/~hans.buys" voor EhB hosting, "" voor localhost

defined("VIEW_PATH")
    or define("VIEW_PATH", ROOT_PATH.'/view');

defined("MODEL_PATH")
    or define("MODEL_PATH", ROOT_PATH.'/viewModel');

defined("SERVICE_PATH")
    or define("SERVICE_PATH", ROOT_PATH.'/service');

defined("CONTROLLER_PATH")
    or define("CONTROLLER_PATH", ROOT_PATH.'/controller');

defined("DEFAULT_CONTROLLER")
or define("DEFAULT_CONTROLLER", "home");

defined("DEFAULT_ACTION")
or define("DEFAULT_ACTION", "index");

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);
?>