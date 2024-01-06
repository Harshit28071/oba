<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
session_start();
$user_id = $_SESSION['s_id'];
$orders = [];
$status = $_POST["status"];
$query = '';
switch ($status) {
    case "New":
        $query = "SELECT orders.id,orders.salesman_id,orders.date,orders.order_status,orders.invoice_id,orders.amount,customer.name,city.name,customer.id from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN city ON customer.city = city.id WHERE orders.salesman_id = ? AND (orders.order_status = 'New') AND invoice_id = 0 order by orders.date desc";
        break;

    case "Pending":
        $query = "SELECT orders.id,orders.salesman_id,orders.date,orders.order_status,orders.invoice_id,orders.amount,customer.name,city.name,customer.id from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN city ON customer.city = city.id WHERE orders.salesman_id = ? AND (orders.order_status = 'Pending') AND invoice_id = 0 order by orders.date desc";
        break;

    case "Completed":
        $query = "SELECT orders.id,orders.salesman_id,orders.date,orders.order_status,orders.invoice_id,orders.amount,customer.name,city.name,customer.id from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN city ON customer.city = city.id WHERE orders.salesman_id = ? AND (orders.order_status = 'Completed') order by orders.date desc limit 50";
        break;

    case "Cancel":
        $query = "SELECT orders.id,orders.salesman_id,orders.date,orders.order_status,orders.invoice_id,orders.amount,customer.name,city.name,customer.id from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN city ON customer.city = city.id WHERE orders.salesman_id = ? AND (orders.order_status = 'Cancel') AND invoice_id = 0 order by orders.date desc";
        break;
}


$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($o_id, $o_salesman_id, $order_date, $order_status, $order_invoice_id, $order_amount, $customer_name, $city_name, $customer_id);

while ($stmt->fetch()) {
    array_push($orders, ['order_id' => $o_id, 'salesman_id' => $o_salesman_id, 'order_date' => $order_date, 'order_status' => $order_status, 'order_invoice_id' => $order_invoice_id, 'order_amount' => $order_amount, 'customer_name' => $customer_name, 'city_name' => $city_name, 'customer_id' => $customer_id]);
}
$stmt->close();
$conn->close();
echo json_encode($orders);
