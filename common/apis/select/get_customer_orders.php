<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
session_start();
$user_id = $_SESSION['s_id'];
$customer_id = $_POST["customerId"];
$orders = [];
$stmt =$conn->prepare("SELECT id,salesman_id,date,order_status,invoice_id,amount from orders WHERE party_id = ? order by date desc limit 50");
$stmt->bind_param("i",$customer_id);
$stmt->execute();
$stmt->bind_result($o_id,$o_salesman_id,$order_date,$order_status,$order_invoice_id,$order_amount);

while($stmt->fetch()){
   
    array_push($orders,['order_id' => $o_id,'salesman_id'=>$o_salesman_id,'order_date'=>$order_date,'order_status'=>$order_status,'order_invoice_id'=>$order_invoice_id,'order_amount'=>$order_amount]);
}
$stmt->close();
$conn->close();
echo json_encode($orders);

?>