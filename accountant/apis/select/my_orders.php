<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
session_start();
$accountant = $_SESSION['s_id'];
$limit = $_POST['limit'];
$start = $_POST['start'];
$orders = [];
$status = $_POST["status"];
$query = '';
switch ($status) {
    case "New":
        $query = "SELECT orders.id,orders.date,orders.order_status,orders.amount, customer.name,user.username from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN user ON orders.salesman_id = user.id WHERE  orders.salesman_id = ? AND (orders.order_status = ?) LIMIT ?,?";
        break;
    case "Pending":
        $query = "SELECT orders.id,orders.date,orders.order_status,orders.amount, customer.name,user.username from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN user ON orders.salesman_id = user.id WHERE orders.salesman_id = ? AND (orders.order_status = ?) LIMIT ?,?";
        break;

    case "Completed":
        $query = "SELECT orders.id,orders.date,orders.order_status,orders.amount,customer.name,user.username from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN user ON orders.salesman_id = user.id WHERE orders.salesman_id = ? AND (orders.order_status = ?) LIMIT ?,?";
        break;

    case "Cancel":
        $query = "SELECT orders.id,orders.date,orders.order_status,orders.amount,customer.name,user.username from orders LEFT JOIN customer ON orders.party_id = customer.id LEFT JOIN user ON orders.salesman_id = user.id WHERE orders.salesman_id = ? AND (orders.order_status = ?) LIMIT ?,?";
        break;
}


$stmt = $conn->prepare($query);
$stmt->bind_param("isii",$accountant,$status,$start,$limit);
$stmt->execute();
$stmt->bind_result($o_id,$order_date,$order_status,$order_amount, $customer_name,$salesmanname);


while ($stmt->fetch()) {
    array_push($orders, ['order_id' => $o_id,'order_date' => $order_date, 'order_status' => $order_status,'order_amount' => $order_amount, 'customer_name' => $customer_name, 'salesmanname' => $salesmanname]);
}

$stmt->close();
$conn->close();

if (!empty($orders)) {
    $orders['checkResponse'] = 1;
} else {
    $orders['checkResponse'] = 0;
    
}
echo json_encode($orders);
