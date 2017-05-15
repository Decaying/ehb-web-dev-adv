<?php

require_once("log.php");

class SqlContext {
    private $config;
    private $log;
    private $connection;

    function __construct(Log $log) {
        global $config;

        $this->config = $config;
        $this->log = $log;

        $this->connection = $this->getConnection();
        $this->checkConnection();
    }

    private function getConnection() {
        return new mysqli($this->config["db"]["hostname"], $this->config["db"]["user"], $this->config["db"]["pass"], $this->config["db"]["database"]);
    }

    public function executeMulti(array $statements) {
        $this->connection->autocommit(false);
        $this->connection->begin_transaction();
        $this->log->info("MySql transaction started");

        foreach ($statements as $statement){
            $this->executeOne($statement);
        }

        if (!$this->connection->commit())
            throw new Exception("commit failed");

        $this->log->info("successfully committed to MySql");
    }

    public function executeOne($sql) {
        $this->initialize();

        $this->log->info("executing query: ");
        $this->log->info($sql);

        $result = $this->connection->query($sql);
        $this->log->info($this->connection->error);

        $this->checkQuery();

        return $result;
    }

    public function escape_string($string) {
        $this->initialize();
        return $this->connection->escape_string($string);
    }

    public function close() {
        $result = $this->connection->close();

        if ($result)
            $this->log->info("MySql connection closed");
        else
            throw new Exception("Could not close the MySql connection");

        $this->connection = null;

        return $result;
    }

    private function initialize() {
        if ($this->connection === null) {
            $this->connection = $this->getConnection();

            $this->log->info("MySql connection created");
        }
    }

    private function checkConnection() {
        if ($this->connection->connect_error)
            throw new Exception("MySql connection failed: " . $this->connection->connect_error);
    }

    private function checkQuery() {
        if ($this->connection->error)
            throw new Exception("MySql query failed: " . $this->connection->error);
    }
}