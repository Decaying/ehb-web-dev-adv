<?php

require_once("log.php");

class BrowserLog implements Log {

    /**
     * @return bool
     */
    function infoEnabled() {
        global $loggingEnabled;
        return $loggingEnabled;
    }

    /**
     * @return bool
     */
    function errorEnabled() {
        global $loggingEnabled;
        return $loggingEnabled;
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