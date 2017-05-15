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
        if ($this->infoEnabled())
            echo '<script>console.log(`' . $message . '`);</script>';
    }

    /**
     * @param $message
     * @return void
     */
    function error($message) {
        if ($this->errorEnabled())
            echo '<script>console.error(`' . $message . '`);</script>';
    }
}