<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
session_start();
$user_id = $_SESSION['s_id'];
$orders_status = [];
$stmt =$conn->prepare("SELECT orders.id,orders.salesman_id,orders.date,orders.order_status,orders.invoice_id,orders.amount,customer.name from orders LEFT JOIN customer ON orders.party_id = customer.id WHERE orders.salesman_id = ? AND (orders.order_status = 'New' OR orders.order_status = 'Pending')");
$stmt->bind_param("i",$user_id);
$stmt->execute();
$stmt->bind_result($o_id,$o_salesman_id,$order_date,$order_status,$order_invoice_id,$order_amount,$customer_name);

while($stmt->fetch()){
    array_push($orders_status,['order_id' => $o_id,'salesman_id'=>$o_salesman_id,'order_date'=>$order_date,'order_status'=>$order_status,'order_invoice_id'=>$order_invoice_id,'order_amount'=>$order_amount,'customer_name'=>$customer_name ]);
}
$stmt->close();
$conn->close();
echo json_encode($orders_status);

?>