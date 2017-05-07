<?php

class Mailer {

    public function sendMailToAdmin($user, $remarks) {

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $message = "
            <html>
            <head>
                <title>Contact request</title>
            </head>
            <body>
                <p>A contact request has been made by " . $user . "</p>
                <p>" . $remarks . "</p>
            </body>
            </html>";


        global $config;
        $admin = $config["admin"];
        mail($admin, "Contact request - " . $user, wordwrap($message), $headers);
    }
}