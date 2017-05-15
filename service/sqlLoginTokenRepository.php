<?php

require_once("loginTokenRepository.php");
require_once("sqlContext.php");

class SqlLoginTokenRepository implements LoginTokenRepository {

    private $context;

    function __construct(SqlContext $context) {
        $this->context = $context;
    }

    function addSession($user) {
        $email = $this->context->escape_string($user);
        $token = uniqid();
        $now = new DateTime();
        $nextMonth = $now->add(new DateInterval("P1M"));
        $valid_through = date_format($nextMonth, "Y-m-d H:i:s");
        $this->context->executeOne("INSERT INTO Tokens (email, token, valid_through) VALUES ('$email', '$token', '$valid_through')");
        return $token;
    }

    function isTokenValid($user, $token) {
        $email = $this->context->escape_string($user);

        $result = $this->context->executeOne("SELECT count(email) FROM Tokens WHERE email = '$email' AND token = '$token' AND valid_through > CURRENT_TIMESTAMP()");
        if ($result){
            $row = $result->fetch_row();
            return ((int)$row[0]) > 0;
        }
        return false;
    }
}