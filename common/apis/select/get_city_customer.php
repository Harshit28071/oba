<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$id = $_POST['id'];
$customer = []; 
$stmt =$conn->prepare("SELECT customer.id,customer.name,customer.address,customer.GSTIN,customer.mobile_number,state.state,state.state_code FROM customer 
LEFT JOIN city ON customer.city = city.id 
LEFT JOIN state ON customer.state_id = state.id
WHERE city = ? order by customer.name");
$stmt->bind_param("i",$id);
$stmt->bind_result($id,$name,$address,$gstin,$mobile,$state,$state_code);
$stmt->execute();
while($stmt->fetch()){
    array_push($customer,['id' =>$id, 'cname' =>$name,'address' =>$address,'gstin'=>$gstin,'mobile'=>$mobile,'state'=>$state,'state_code'=>$state_code]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);

?>