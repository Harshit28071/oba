<?php
header('Content-Type: application/json');
session_start();
$user_id = $_SESSION['s_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$orders = [];
$new_count = 0;
$completed_count = 0;
$pending_count = 0;
$cancel_count = 0;

//Quary For Pending Orders
$stmt =$conn->prepare("SELECT COUNT(id)  FROM orders WHERE (order_status='New') AND invoice_id = 0 AND salesman_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($rowCount);
while($stmt->fetch()){
    $new_count = $rowCount;
}

$stmt =$conn->prepare("SELECT COUNT(id)  FROM orders WHERE (order_status='Pending') AND invoice_id = 0 AND salesman_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($rowCount);
while($stmt->fetch()){
    $pending_count = $rowCount;
}


//Quary For Approved Orders
$stmt = $conn->prepare("SELECT COUNT(id) FROM orders WHERE (order_status='Completed')  AND invoice_id != 0 AND salesman_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($rowCount);
while($stmt->fetch()){
    $completed_count = $rowCount;
}


$stmt = $conn->prepare("SELECT COUNT(id) FROM orders WHERE order_status='Cancel' AND salesman_id = ?");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($rowCount);
while($stmt->fetch()){
    $cancel_count = $rowCount;
}


array_push($orders,['new_count' =>$new_count,'pending_count'=>$pending_count,'completed_count'=>$completed_count,'cancel_count'=>$cancel_count]);

$stmt->close();
$conn->close();
echo json_encode($orders);
?>