<?php
include($_SERVER['DOCUMENT_ROOT'] . '/new/oba/common/database.php');
session_start();
if (!isset($_SESSION['s_username']) && $_SESSION["s_role"] != "Accountant") {
    header("location:/new/oba/common/user_login.php");
}
$db = new Database();
$conn = $db->connect();
$products = [];

$orderId = $_POST["orderId"];
$stmt = $conn->prepare("SELECT p.*,b.name FROM orders, JSON_TABLE(products, '$[*]' COLUMNS (id int(10) Path '$.id',  punit VARCHAR(50) Path '$.punit',quantity float(10) Path '$.quantity',itemPrice float(11) PATH '$.itemPrice',discount float(11) PATH '$.discount')) p left join product b on p.id = b.id where orders.id = ?");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$stmt->bind_result($id, $unit, $qty, $price, $discount, $name);

while ($stmt->fetch()) {
    array_push($products, ['id' => $id, 'name' => $name, 'price' => $price, 'unit' => $unit, 'quantity' => $qty, 'discount' => $discount]);
}
$stmt->close();
$conn->close();

echo json_encode($products);
