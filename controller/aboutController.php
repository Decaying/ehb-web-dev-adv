<?php
require_once(VIEW_PATH . "/about.php");
require_once(MODEL_PATH . "/aboutViewModel.php");

class AboutController {
    public function index() {
        $view = new About();
        $vm = new AboutViewModel();
        $view->render($vm);
    }
}