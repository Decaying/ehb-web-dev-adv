<?php

interface PurchaseRepository {

    function getNumberOfItemsInCart();
    function addToCart(CustomBike $bike);
}