<?php
require_once(VIEW_PATH . "/home.php");
require_once(MODEL_PATH . "/homeViewModel.php");

class HomeController {
    public function index() {
        $view = new Home();
        $model = new HomeViewModel();
        $view->render($model);
    }
}