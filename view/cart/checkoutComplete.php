<?php

namespace cart;

use Bike;
use View;

require_once(VIEW_PATH . "/view.php");
require_once(VIEW_PATH . "/bike.php");
require_once(MODEL_PATH . "/cart/checkoutCompleteViewModel.php");

class CheckoutComplete implements View {

    private $vm;

    function __construct(CheckoutCompleteViewModel $vm) {
        $this->vm = $vm;
    }

    function render() {
        echo '
<h3>Checkout complete</h3>

<h4>Goods</h4>
';
        Bike::renderBikes($this->vm->getBikes());
echo '
<h4>Delivery address</h4>
<p><strong>Street:</strong> ' . $this->vm->getDlvAddress()->getStreet() . ' </p> 
<p><strong>Zipcode:</strong> ' . $this->vm->getDlvAddress()->getZipcode() . ' </p> 
<p><strong>City:</strong> ' . $this->vm->getDlvAddress()->getCity() . ' </p> 
<h4>Invoice address</h4>
<p><strong>Street:</strong> ' . $this->vm->getInvAddress()->getStreet() . ' </p> 
<p><strong>Zipcode:</strong> ' . $this->vm->getInvAddress()->getZipcode() . ' </p> 
<p><strong>City:</strong> ' . $this->vm->getInvAddress()->getCity() . ' </p> 
<p></p>
<p><strong>Payment method:</strong> ' . $this->vm->getPaymentMethod() . '</p>
<p><strong>Delivery method:</strong> ' . $this->vm->getDeliveryMethod() . '</p>
<p></p>
<p>You have agreed to our terms and conditions</p>
        ';
    }

}