<?php

use cart\AddressViewModel;
use manage\orders\Index;

require_once("controller.php");
require_once(VIEW_PATH . "/notAuthorized.php");
require_once(VIEW_PATH . "/manage/orders/index.php");
require_once(MODEL_PATH . "/manage/orderViewModel.php");
require_once(MODEL_PATH . "/cart/addressViewModel.php");
require_once(SERVICE_PATH . "/model/order.php");

class ManageOrdersController extends Controller {

    private $orders;
    private $auth;

    function __construct(OrderRepository $orders, AuthenticationManager $auth) {
        $this->orders = $orders;
        $this->auth = $auth;
    }

    public function index() {
        if (!$this->auth->userIsAdmin()) {
            return new NotAuthorized();
        }

        $orders = $this->getAllOrders();

        return new Index($orders);
    }

    /**
     * return array
     */
    private function getAllOrders() {
        $orders = $this->orders->get();

        return $this->toOrderViewModels($orders);
    }

    /**
     * @param $orders
     * @return array
     */
    private function toOrderViewModels($orders) {
        $vms = array();

        foreach ($orders as $order) {
            $vms[] = $this->toOrderViewModel($order);
        }

        return $vms;
    }

    /**
     * @param Order $order
     * @return OrderViewModel
     */
    private function toOrderViewModel(Order $order) {
        $dlv = new AddressViewModel($order->getDeliveryAddress());
        $inv = new AddressViewModel($order->getInvoiceAddress());

        return new OrderViewModel($order->getId(), $order->getUserFirstname(), $order->getUserLastname(), $order->getDlvMethod(), $order->getInvMethod(), $dlv, $inv);
    }

}