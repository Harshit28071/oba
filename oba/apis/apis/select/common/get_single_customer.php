<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$c_id = $_POST['id'];
$customer = [];
$stmt =$conn->prepare("SELECT customer.id,customer.name,customer.mobile_number,customer.address,customer.firm_name,customer.GSTIN,customer.type,customer.distributor_id,state.state,city.name FROM customer LEFT JOIN city ON customer.city = city.id LEFT JOIN state ON customer.state_id = state.id WHERE customer.id = ?");
$stmt->bind_param("i",$c_id);
$stmt->execute();
$stmt->bind_result($customer_id,$customer_name,$customer_mobile_number,$customer_address,$customer_firm_name,$customer_GSTIN,$customer_type,$customer_distributor_id,$customer_state,$customer_city);

while($stmt->fetch()){
    array_push($customer,['cid' =>$customer_id, 'cname' =>$customer_name,'cmobile' => $customer_mobile_number,'caddress' =>$customer_address,'cfirm' =>$customer_firm_name,'cGSTIN' =>$customer_GSTIN,'ctype' =>$customer_type,'cdistributor_id' =>$customer_distributor_id,'cstate' => $customer_state,'ccity' =>$customer_city]);
}
$stmt->close();
$conn->close();
echo json_encode($customer);

?>