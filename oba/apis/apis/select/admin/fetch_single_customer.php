<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$cust_id = $data['cust_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$customer = [];
$stmt = $conn->prepare("SELECT id,name,mobile_number,state_id,city,address,firm_name,GSTIN,type,distributor_id FROM customer WHERE id = ?");
$stmt->bind_param("i",$cust_id);
$stmt ->bind_result($id,$name,$mobile_number,$state_id,$city,$address,$firm_name,$GSTIN,$type,$distributor_id);
$stmt->execute();
while($stmt->fetch()){
    array_push($customer,['id' => $id,'name' => $name ,'mobile_number' => $mobile_number,'state_id' => $state_id,'city' => $city,'address' => $address, 'firm_name' => $firm_name, 'GSTIN' => $GSTIN , 'type' => $type,'distributor_id' => $distributor_id]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);
?>