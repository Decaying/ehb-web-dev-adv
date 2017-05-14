<?php

require_once("soldItemsRepository.php");
require_once("model/cartItem.php");

class SqlSoldItemsRepository implements SoldItemsRepository {

    private $context;

    function __construct(SqlContext $context) {
        $this->context = $context;
    }

    function add(User $user, array $itemsInCart, Address $invAddress, Address $dlvAddress, $invMethod, $dlvMethod, $agreedToTerms) {

        $sql = "BEGIN;";

        $sql .= $this->addAddress($invAddress, "@InvoiceAddressId");
        $sql .= $this->addAddress($dlvAddress, "@DeliveryAddressId");

        echo "
INSERT INTO Sales (user_id, invoice_address_id, delivery_address_id, invoice_method, delivery_method, agreed_to_terms)
    VALUES ('" . $user->getId() . "', '@InvoiceAddressId', '@DeliveryAddressId', '" . $invMethod . "', '" . $dlvMethod . "', '" . $agreedToTerms . "');
SELECT LAST_INSERT_ID() INTO @SaleId;";

        foreach($itemsInCart as $item){
            $sql .= $this->addCartItem($item);
        }
        
        $sql .= "COMMIT;";

        $this->context->execute($sql);
    }

    /**
     * @param $item
     * @param $sql
     * @return string
     */
    public function addCartItem(CartItem $item) {
        $sql = "
INSERT INTO SalesLine (sales_id, bike_id, amount)
    VALUES ('@SaleId', '" . $item->bikeId . "', '" . $item->amount . "');
            ";
        return $sql;
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
}