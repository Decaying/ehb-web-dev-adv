<?php

interface Log {
    /**
     * @return bool
     */
    function infoEnabled();

    /**
     * @return bool
     */
    function errorEnabled();

    /**
     * @param $message
     * @return void
     */
    function info($message);

    /**
     * @param $message
     * @return void
     */
    function error($message);
}