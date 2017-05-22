<?php

use manage\orders\Index;

require_once("controller.php");
require_once(VIEW_PATH . "/manage/orders/index.php");

class ManageOrdersController extends Controller {
    public function index() {
        return new Index();
    }
}