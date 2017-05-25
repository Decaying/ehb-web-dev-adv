<?php

namespace manage\orders;

require_once(VIEW_PATH . "/view.php");
require_once(MODEL_PATH . "/manage/orderDetailViewModel.php");
require_once(MODEL_PATH . "/manage/orderLineViewModel.php");

use OrderDetailViewModel;
use OrderLineViewModel;
use View;

class Detail implements View {

    private $order;

    function __construct(OrderDetailViewModel $order) {
        $this->order = $order;
    }

    function render() {
        $order = $this->order;
        $dlvAddress = $order->getDlvAddress();
        $invAddress = $order->getInvAddress();

        $firstname = $order->getFirstname();
        $lastname = $order->getLastname();

        $dlvMethod = $order->getDlvMethod();
        $invMethod = $order->getInvMethod();

        $dlvStreet = $dlvAddress->getStreet();
        $dlvZip = $dlvAddress->getZipcode();
        $dlvCity = $dlvAddress->getCity();

        $invStreet = $invAddress->getStreet();
        $invZip = $invAddress->getZipcode();
        $invCity = $invAddress->getCity();

        echo "
<div class='panel panel-success'>
    <div class='panel-heading'>
        <h4>$firstname $lastname</h4>
    </div>
    <div class='panel-body'>
        <p>To be delivered using <strong>$dlvMethod</strong> to:</p>
        <div class='address'><p>$dlvStreet <br> $dlvZip $dlvCity </p></div>
        <p>Paid with <strong>$invMethod</strong>. Send the invoice to:<p>
        <div class='address'><p>$invStreet <br> $invZip $invCity </p></div>";

        if (count($this->order->getOrderLines())) {

            echo "<p>This customer bought:</p>
            <ul>";

            foreach ($this->order->getOrderLines() as $orderLine) {
                $this->renderOrderLine($orderLine);
            }

            echo "</ul>
        </div>
        </div>";
        } else {
            echo "<p>This customer didn't buy anything.</p>";
        }
    }

    private function renderOrderLine(OrderLineViewModel $orderLine) {
        $root = SITE_ROOT;
        $bikeId = $orderLine->getBikeId();
        $bikeName = $orderLine->getBikeName();
        $price = $orderLine->getPriceWithCurrency();
        $amount = $orderLine->getAmount();

        echo "<li>$amount x <a href='$root/bikes/$bikeId'>$bikeName</a> at $price</li>";
    }
}