<?php

require_once("model/user.php");
require_once("model/address.php");

interface SoldItemsRepository {
    function add(User $user, array $itemsInCart, Address $invAddress, Address $dlvAddress, $invMethod, $dlvMethod, $agreedToTerms);
}