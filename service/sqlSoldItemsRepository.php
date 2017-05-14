<?php

require_once("soldItemsRepository.php");
require_once("model/cartItem.php");
require_once("sqlContext.php");

class SqlSoldItemsRepository implements SoldItemsRepository {

    private $context;

    function __construct(SqlContext $context) {
        $this->context = $context;
    }

    public function add(User $user, array $itemsInCart, Address $invAddress, Address $dlvAddress, $invMethod, $dlvMethod, $agreedToTerms) {
        $selectIntoInvoiceAddressId = "@InvoiceAddressId";
        $selectIntoDeliveryAddressId = "@DeliveryAddressId";
        $selectIntoSaleId = "@SaleId";

        $statements = array();
        $statements[] = $this->addAddress($dlvAddress);
        $statements[] = $this->getLastId($selectIntoDeliveryAddressId);

        if ($invAddress !== $dlvAddress) {
            $statements[] = $this->addAddress($invAddress);
            $statements[] = $this->getLastId($selectIntoInvoiceAddressId);
        } else {
            $selectIntoInvoiceAddressId = $selectIntoDeliveryAddressId;
        }

        $statements[] = $this->addSale($user, $invMethod, $dlvMethod, $agreedToTerms, $selectIntoInvoiceAddressId, $selectIntoDeliveryAddressId);
        $statements[] = $this->getLastId($selectIntoSaleId);

        foreach($itemsInCart as $item){
            $statements[] =  $this->addCartItem($item, $selectIntoSaleId);
        }

        $this->context->executeMulti($statements);
    }

    private function getLastId($selectInto) {
        return "SET " . $selectInto . " = LAST_INSERT_ID();";
    }

    private function addAddress(Address $dlvAddress) {
        $street = $this->context->escape_string($dlvAddress->getStreet());
        $zipcode = $this->context->escape_string($dlvAddress->getZipcode());
        $city = $this->context->escape_string($dlvAddress->getCity());
        return "INSERT INTO Address(street,zipcode,city) VALUES ('" . $street . "','" . $zipcode . "','" . $city . "');";
    }

    private function addSale(User $user, $invMethod, $dlvMethod, $agreedToTerms, $invoiceAddressId, $deliveryAddressId) {
        $invoiceMethod = $this->context->escape_string($invMethod);
        $deliveryMethod = $this->context->escape_string($dlvMethod);
        return "INSERT INTO Sales(user_id,invoice_address_id,delivery_address_id,invoice_method,delivery_method,agreed_to_terms) VALUES (" . $user->getId() . "," . $invoiceAddressId . "," . $deliveryAddressId . ",'" . $invoiceMethod . "','" . $deliveryMethod . "'," . $agreedToTerms . ");";
    }

    private function addCartItem(CartItem $item, $saleId) {
        return "INSERT INTO SalesLine(sales_id,bike_id,amount) VALUES (" . $saleId . "," . $item->bikeId . "," . $item->amount . ");";
    }
}