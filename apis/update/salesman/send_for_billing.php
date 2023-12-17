<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');

$data = json_decode(file_get_contents("php://input"),true);

$oid = $data["orderId"];
$sid = $_SESSION["s_id"];

$stmt = $conn->prepare("update `orders` set order_status = 'Pending' where id = ? and salesman_id = ? and invoice_id = 0");
$stmt->bind_param("ii",$oid,$sid);
$stmt->execute();
$result = $stmt->affected_rows;
$stmt->close();
$conn->close();

echo json_encode($result);


?>