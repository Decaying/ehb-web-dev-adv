<?php

require_once("orderRepository.php");
require_once("model/cartItem.php");
require_once("sqlContext.php");
require_once("model/order.php");
require_once("model/orderLine.php");

class SqlOrderRepository implements OrderRepository {

    private $context;
    private $logger;

    function __construct(SqlContext $context, Log $logger) {
        $this->context = $context;
        $this->logger = $logger;
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
        return "INSERT INTO Address(street,zipcode,city) VALUES ('$street','$zipcode','$city');";
    }

    private function addSale(User $user, $invMethod, $dlvMethod, $agreedToTerms, $invoiceAddressId, $deliveryAddressId) {
        $invoiceMethod = $this->context->escape_string($invMethod);
        $deliveryMethod = $this->context->escape_string($dlvMethod);
        $user_id = $user->getId();
        return "INSERT INTO Sales(user_id,invoice_address_id,delivery_address_id,invoice_method,delivery_method,agreed_to_terms) VALUES ($user_id,$invoiceAddressId,$deliveryAddressId,'$invoiceMethod','$deliveryMethod',$agreedToTerms);";
    }

    private function addCartItem(CartItem $item, $saleId) {
        return "INSERT INTO SalesLine(sales_id,bike_id,amount) VALUES ($saleId,$item->bikeId,$item->amount);";
    }

    public function get() {
        $orders = array();

        $sql = $this->getOrders();

        $result = $this->context->executeOne($sql);

        $this->logger->info("fetched results");

        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $this->logger->info("parsing row");
            $order = $this->mapToOrder($row);
            $orders[] = $order;
        }

        return $orders;
    }

    public function getById($id) {
        $escapedId = $this->context->escape_string($id);

        $sql = $this->getOrders() . " WHERE sales.id = $escapedId";
        $result = $this->context->executeOne($sql);

        if (!$result)
            return null;

        $row = $result->fetch_row();
        $order = $this->mapToOrder($row);

        $sql = "SELECT salesLine.amount, bike.id, bike.name 
                FROM SalesLine salesLine
                INNER JOIN Bikes bike ON bike.id = salesLine.bike_id
                WHERE salesLine.sales_id = $id";
        $result = $this->context->executeOne($sql);

        $orderLines = array();

        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $this->logger->info("parsing row");

            $amount = floatval($row[0]);
            $bikeId = (int)$row[1];
            $bikeName = $row[2];

            $orderLines[] = new OrderLine($bikeId, $bikeName, $amount);
        }

        $order->setOrderLines($orderLines);

        return $order;
    }

    /**
     * @return string
     */
    private function getOrders() {
        return "SELECT sales.id, 
                  user.firstname, user.lastname,
                  sales.delivery_method, sales.invoice_method,
                  delivery_address.street, delivery_address.zipcode, delivery_address.city, 
                  invoice_address.street, invoice_address.zipcode, invoice_address.city 
                FROM Sales sales
                INNER JOIN User user ON user.id = sales.user_id
                INNER JOIN Address delivery_address ON delivery_address.id = sales.delivery_address_id
                INNER JOIN Address invoice_address ON invoice_address.id = sales.invoice_address_id";
    }

    /**
     * @param $row
     * @return Order
     */
    private function mapToOrder($row) {
        $id = $row[0];
        $userFirstname = $row[1];
        $userLastname = $row[2];
        $dlvMethod = $row[3];
        $invMethod = $row[4];
        $dlvAddress = new Address($row[5], $row[6], $row[7]);
        $invAddress = new Address($row[8], $row[9], $row[10]);
        $order = new Order($id, $userFirstname, $userLastname, $dlvMethod, $invMethod, $dlvAddress, $invAddress);
        return $order;
    }
}