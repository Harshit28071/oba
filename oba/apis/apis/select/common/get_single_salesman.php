<?php
session_start();
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
//$c_id = $_POST['id'];
$salesman_id = $_SESSION['s_id'];
$salesman = [];
$stmt =$conn->prepare("SELECT a.id,a.name,a.mobile_number,a.address,a.firm_name,a.GSTIN,a.type,a.distributor_id,state.state,city.name,b.name,state.id,city.id FROM customer a LEFT JOIN customer b ON a.id = b.distributor_id LEFT JOIN city ON a.city = city.id LEFT JOIN state ON a.state_id = state.id WHERE a.id = ? ");
$stmt->bind_param("i",$salesman_id);
$stmt->execute();
$stmt->bind_result($salesman_id,$salesman_name,$salesman_mobile_number,$salesman_address,$salesman_firm_name,$salesman_GSTIN,$salesman_type,$salesman_distributor_id,$salesman_state,$salesman_city,$distributor_name,$state_id,$city_id);
while($stmt->fetch()){
    array_push($salesman,['cid' =>$salesman_id, 'cname' =>$salesman_name,'cmobile' => $salesman_mobile_number,'caddress' =>$salesman_address,'cfirm' =>$salesman_firm_name,'cGSTIN' =>$salesman_GSTIN,'ctype' =>$salesman_type,'cdistributor_id' =>$salesman_distributor_id,'cstate' => $salesman_state,'ccity' =>$salesman_city,'distributor_name' => $distributor_name,'state_id' => $state_id,'city_id' => $city_id]);
}
$stmt->close();
$conn->close();
echo json_encode($salesman);

?>