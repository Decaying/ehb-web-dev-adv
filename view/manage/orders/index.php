<?php

namespace manage\orders;

use OrderViewModel;
use View;

require_once(VIEW_PATH . "/view.php");
require_once(MODEL_PATH . "/manage/orderViewModel.php");

class Index implements View {

    private $orders;

    function __construct(array $orders) {
        $this->orders = $orders;
    }

    function render() {
        echo "<h3>Orders</h3>";

        echo "<div class='container' style='margin-top: 10px;'>";
        foreach ($this->orders as $order) {
            echo '<div class="row">';
            $this->renderOrder($order);
            echo '</div>';
        }
        echo "</div>";
    }

    private function renderOrder(OrderViewModel $order) {
        $root = SITE_ROOT;

        $id = $order->getId();
        $firstname = $order->getFirstname();
        $lastname = $order->getLastname();

        $dlvMethod = $order->getDlvMethod();
        $invMethod = $order->getInvMethod();

        $dlvStreet = $order->getDlvAddress()->getStreet();
        $dlvZip = $order->getDlvAddress()->getZipcode();
        $dlvCity = $order->getDlvAddress()->getCity();

        $invStreet = $order->getInvAddress()->getStreet();
        $invZip = $order->getInvAddress()->getZipcode();
        $invCity = $order->getInvAddress()->getCity();

        echo "
<div class='panel panel-success'>
    <div class='panel-heading'>
        <h4><a href='$root/manage-orders/details/$id'>$firstname $lastname</a></h4>
    </div>
    <div class='panel-body'>
        <p>To be delivered using <strong>$dlvMethod</strong> to:</p>
        <div class='address'><p>$dlvStreet <br> $dlvZip $dlvCity </p></div>
        <p>Paid with <strong>$invMethod</strong>. Send the invoice to:<p>
        <div class='address'><p>$invStreet <br> $invZip $invCity </p></div>
    </div>
</div>
";
    }
}