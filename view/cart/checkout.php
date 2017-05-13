<?php
/**
 * Created by PhpStorm.
 * User: HansB
 * Date: 12/05/2017
 * Time: 19:36
 */

namespace cart;

use View;

require_once(VIEW_PATH . "/view.php");
require_once(MODEL_PATH . "/cart/checkoutViewModel.php");

class Checkout implements View {

    private $vm;

    function __construct(CheckoutViewModel $vm) {
        $this->vm = $vm;
    }

    function render() {
        echo '
<script src="' . SITE_ROOT .'/js/validations.js" lang="javascript"></script>
<script src="' . SITE_ROOT .'/js/checkout.js" lang="javascript"></script>
<h3>Checkout</h3>

<form action="" method="post">
    <div class="form-group">
        <label for="dlvName">Name</label>
        <input class="form-control" id="dlvName" type="text" placeholder="' . $this->vm->getDeliveryname() . '" disabled>
    </div>
    <div class="form-group">
        <label for="dlvStreet">Street and number</label>
        <input type="text" class="form-control" id="dlvStreet" placeholder="Where shall we deliver?">
    </div>
    <div class="form-group">
        <label for="dlvZip">Zipcode</label>
        <input type="text" maxlength="4" class="form-control" id="dlvZip">
    </div>
    <div class="form-group">
        <label for="dlvCity">City</label>
        <input type="text" class="form-control" id="dlvCity">
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
            <input type="checkbox" id="useDlvAsInv" name="useDlvAsInv" checked> Use delivery address for invoicing?
            </label>
        </div>
    </div>
    <div id="invAddr" class="hide">
        <div class="form-group">
            <label for="invStreet">Street and number</label>
            <input type="text" class="form-control" id="invStreet" placeholder="Where can we send the bill?">
        </div>
        <div class="form-group">
            <label for="invZip">Zipcode</label>
            <input type="text" maxlength="4" class="form-control" id="invZip">
        </div>
        <div class="form-group">
            <label for="invCity">City</label>
            <input type="text" class="form-control" id="invCity">
        </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
';
    }
}