<?php

require_once("log.php");

class SqlContext {
    private $config;
    private $log;

    function __construct(Log $log) {
        global $config;
        $this->config = $config;
        $this->log = $log;
    }

    private function getConnection() {
        $conn = new mysqli($this->config["db"]["hostname"], $this->config["db"]["user"], $this->config["db"]["pass"], $this->config["db"]["database"]);

        if (mysqli_connect_errno())
            throw new Exception("Connection failed: " . $conn->connect_error);

        $this->log->info("sql connection created");

        return $conn;
    }

    private function close(mysqli $conn) {
        $result = $conn->close();

        $this->log->info("sql connection closed");

        return $result;
    }

    public function execute($sql, $isTransactional) {
        $conn = $this->getConnection();

        if ($isTransactional)
            $conn->autocommit(false);

        $this->log->info("executing query: ");
        $this->log->info($sql);

        $success = $conn->query($sql);

        $this->log->info("executed query: " . $success ? "success" : "error");

        if ($isTransactional) {
            if (!$conn->commit())
                throw new Exception("commit failed");

            $this->log->info("successfully commited sql");
        }

        $this->close($conn);

        return $success;
    }
}