<?php

require_once("soldItemsRepository.php");
require_once("log.php");
require_once("model/cartItem.php");

class SqlSoldItemsRepository implements SoldItemsRepository {

    private $context;

    function __construct(SqlContext $context) {
        $this->context = $context;
    }

    function add(User $user, array $itemsInCart, Address $invAddress, Address $dlvAddress, $invMethod, $dlvMethod, $agreedToTerms) {
        $selectIntoInvoiceAddressId = "@InvoiceAddressId";
        $selectIntoDeliveryAddressId = "@DeliveryAddressId";
        $selectIntoSaleId = "@SaleId";

        $sql = "BEGIN;";

        $sql .= $this->addAddress($dlvAddress, $selectIntoDeliveryAddressId);

        if ($invAddress !== $dlvAddress) {
            $sql .= $this->addAddress($invAddress, $selectIntoInvoiceAddressId);
        } else {
            $selectIntoInvoiceAddressId = $selectIntoDeliveryAddressId;
        }

        $sql .= $this->addSale($user, $invMethod, $dlvMethod, $agreedToTerms, $selectIntoInvoiceAddressId, $selectIntoDeliveryAddressId, $selectIntoSaleId);

        foreach($itemsInCart as $item){
            $sql .= $this->addCartItem($item, $selectIntoSaleId);
        }
        
        $sql .= "
COMMIT;";

        $this->context->execute($sql, true);
    }

    /**
     * @param $item
     * @param $sql
     * @return string
     */
    public function addCartItem(CartItem $item, $saleId) {
        return "
INSERT INTO SalesLine (sales_id, bike_id, amount)
    VALUES (" . $saleId . ", " . $item->bikeId . ", " . $item->amount . ");
            ";
    }

    /**
     * @param Address $dlvAddress
     * @param $selectInto
     * @return string
     */
    public function addAddress(Address $dlvAddress, $selectInto) {
        return "
INSERT INTO Address (street, zipcode, city)
    VALUES ('" . $dlvAddress->getStreet() . "', '" . $dlvAddress->getZipcode() . "', '" . $dlvAddress->getCity() . "');
SELECT LAST_INSERT_ID() INTO " . $selectInto . ";";
    }

    /**
     * @param User $user
     * @param $invMethod
     * @param $dlvMethod
     * @param $agreedToTerms
     * @param $selectIntoInvoiceAddressId
     * @param $selectIntoDeliveryAddressId
     * @param $sql
     * @return string
     */
    public function addSale(User $user, $invMethod, $dlvMethod, $agreedToTerms, $invoiceAddressId, $deliveryAddressId, $selectInto) {
        return "
INSERT INTO Sales (user_id, invoice_address_id, delivery_address_id, invoice_method, delivery_method, agreed_to_terms)
    VALUES (" . $user->getId() . ", " . $invoiceAddressId . ", " . $deliveryAddressId . ", '" . $invMethod . "', '" . $dlvMethod . "', " . $agreedToTerms . ");
SELECT LAST_INSERT_ID() INTO " . $selectInto . ";";
    }
}