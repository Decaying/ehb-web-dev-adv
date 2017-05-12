<?php

use contact\Index;
use contact\MessageSent;

require_once("controller.php");
require_once(VIEW_PATH . "/contact/index.php");
require_once(VIEW_PATH . "/contact/messageSent.php");
require_once(SERVICE_PATH . "/authenticationManager.php");
require_once(SERVICE_PATH . "/mailer.php");
require_once(SERVICE_PATH . "/model/user.php");

class ContactController extends Controller {
    private $users;
    private $mailer;

    function __construct(AuthenticationManager $users, Mailer $mailer) {
        $this->users = $users;
        $this->mailer = $mailer;
    }

    public function index() {
        if ($this->users->isUserLoggedIn())
            return new Index();
        else
            $this->redirectToLogin();
    }

    public function send() {
        if ($this->users->isUserLoggedIn() && $_POST["form-id"] === "contact") {
            $remarks = htmlspecialchars($_POST["remarks"]);
            $user = $this->users->getUser();

            if ($this->mailer->sendMailToAdmin($user, $remarks))
                return new MessageSent();
            else
                throw new Exception("Unable to send mail");
        }
        $this->redirectToHome();
    }
}