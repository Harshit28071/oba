<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$cust_id = $data['cust_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$customer = [];
$stmt = $conn->prepare("SELECT a.id,a.name,a.mobile_number,a.state_id,a.city,a.address,a.firm_name,a.GSTIN,a.type,a.distributor_id,IFNULL(b.name,'-') as distributor,c.state,d.name FROM customer a left join customer b on a.distributor_id = b.id left join state c on a.state_id = c.id left join city d on a.city = d.id WHERE a.id = ?");
$stmt->bind_param("i",$cust_id);
$stmt ->bind_result($id,$name,$mobile_number,$state_id,$city_id,$address,$firm_name,$GSTIN,$type,$distributor_id,$distributor,$state,$city);
$stmt->execute();
while($stmt->fetch()){
    array_push($customer,['id' => $id,'name' => $name ,'mobile_number' => $mobile_number,'state_id' => $state_id,'city_id' => $city_id,'address' => $address, 'firm_name' => $firm_name, 'GSTIN' => $GSTIN , 'type' => $type,'distributor_id' => $distributor_id,"state"=>$state,"city"=>$city,"distributor"=>$distributor]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);
?>