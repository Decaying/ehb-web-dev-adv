<?php
    $config = array(
        "db" => array(
            "host" => "",
            "user" => "",
            "pass" => "",
        ),
        "paths" => array(
            "resources" => "/res",
            "images" => "/img"
        )
    );

defined("ROOT_PATH")
or define("ROOT_PATH", getenv("DOCUMENT_ROOT"));

defined("VIEW_PATH")
    or define("VIEW_PATH", ROOT_PATH.'/view');

defined("MODEL_PATH")
    or define("MODEL_PATH", ROOT_PATH.'/model');

ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);
?>