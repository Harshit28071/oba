<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$details = [];
session_start();
if($_SESSION["s_role"] == "Accountant"){
$invoiceId = $_POST["id"];

$stmt =$conn->prepare("SELECT i.date,i.amount,a.name,a.mobile_number,a.address,a.GSTIN,b.name as city,c.state FROM `invoice` i  left join customer a on i.party_id = a.id left join city b on a.city = b.id left join state c on a.state_id = c.id where i.invoice_number = ?");
$stmt->bind_param("s",$invoiceId);
$stmt->execute();
$stmt->bind_result($date,$amount,$name,$mobile,$address,$gstin,$city,$state);

while($stmt->fetch()){
    array_push($details,['date' =>$date, 'amount' =>$amount,'name' => $name,'mobile' =>$mobile,'address' =>$address,'gstin'=>$gstin,'city'=>$city,'state'=>$state]);
}
$stmt->close();
$conn->close();
}
echo json_encode($details);

?>