<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$c_id = $_POST['id'];
$customer = [];
$stmt =$conn->prepare("SELECT a.id,a.name,a.mobile_number,a.address,a.firm_name,a.GSTIN,a.type,a.distributor_id,state.state,city.name,b.name FROM customer a LEFT JOIN customer b ON a.id = b.distributor_id LEFT JOIN city ON a.city = city.id LEFT JOIN state ON a.state_id = state.id WHERE a.id = ? ");
$stmt->bind_param("i",$c_id);
$stmt->execute();
$stmt->bind_result($customer_id,$customer_name,$customer_mobile_number,$customer_address,$customer_firm_name,$customer_GSTIN,$customer_type,$customer_distributor_id,$customer_state,$customer_city,$distributor_name);

while($stmt->fetch()){
    array_push($customer,['cid' =>$customer_id, 'cname' =>$customer_name,'cmobile' => $customer_mobile_number,'caddress' =>$customer_address,'cfirm' =>$customer_firm_name,'cGSTIN' =>$customer_GSTIN,'ctype' =>$customer_type,'cdistributor_id' =>$customer_distributor_id,'cstate' => $customer_state,'ccity' =>$customer_city,'distributor_name' => $distributor_name]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);

?>