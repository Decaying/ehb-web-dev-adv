<?php

class SqlContext {
    private $config;

    function __construct() {
        global $config;
        $this->config = $config;
    }

    private function getConnection() {
        $conn = new mysqli($this->config["db"]["hostname"], $this->config["db"]["user"], $this->config["db"]["pass"], $this->config["db"]["database"]);
        if (!!$conn->connect_error)
            throw new Exception("Connection failed: " . $conn->connect_error);
        return $conn;
    }

    private function close(mysqli $conn) {
        return $conn->close();
    }

    public function execute($sql) {
        $conn = $this->getConnection();

        $success = $conn->query($sql);

        $this->close($conn);

        return $success;
    }
}