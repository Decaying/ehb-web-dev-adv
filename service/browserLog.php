<?php

require_once("log.php");

class BrowserLog implements Log {

    /**
     * @return bool
     */
    function infoEnabled() {
        return true;
    }

    /**
     * @return bool
     */
    function errorEnabled() {
        return true;
    }

    /**
     * @param $message
     * @return void
     */
    function info($message) {
        echo '<script>console.log(`' . $message . '`);</script>';
    }

    /**
     * @param $message
     * @return void
     */
    function error($message) {
        echo '<script>console.error(`' . $message . '`);</script>';
    }
}