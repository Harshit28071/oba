<?php
header('Content-Type: application/json');
session_start();
$user_id = $_SESSION['s_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$orders = [];
//Quary For Pending Orders
$stmt =$conn->prepare("SELECT COUNT(id)  FROM orders WHERE (order_status='New' OR order_status='Pending') AND invoice_id = 0 AND salesman_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($rowCount);
$stmt->fetch();
$total_count = $rowCount;
$stmt->close();
//Quary For Approved Orders
$sql = $conn->prepare("SELECT COUNT(id) FROM orders WHERE order_status='Completed'  AND invoice_id != 0 AND salesman_id = ?");
$sql->bind_param("i",$user_id);
$sql->execute();
mysqli_stmt_bind_result($sql, $rowCount1);
mysqli_stmt_fetch($sql);
$total_count_approve = $rowCount1;

array_push($orders,['count' =>$total_count,'approve_count'=>$total_count_approve]);

$sql->close();
$conn->close();
echo json_encode($orders);
?>