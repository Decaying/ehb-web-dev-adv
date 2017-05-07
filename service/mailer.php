<?php

require_once(SERVICE_PATH . "/user.php");

class Mailer {

    public function sendMailToAdmin(User $user, $remarks) {

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $message = "
            <html>
            <head>
                <title>Contact request</title>
            </head>
            <body>
                <p>A contact request has been made by " . $user->getFirstname() . " " . $user->getLastname() . "</p>
                <p>Email address: " . $user->getEmail() . "</p>
                <p>" . $remarks . "</p>
            </body>
            </html>";


        global $config;
        $admin = $config["admin"];
        return mail($admin, "Contact request - " . $user->getEmail(), wordwrap($message), $headers);
    }
}