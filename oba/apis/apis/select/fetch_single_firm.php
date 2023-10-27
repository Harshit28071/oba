<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
$f_id = $data['firmviewid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$firm_s = [];
$stmt =$conn->prepare("SELECT * FROM firm  WHERE id = ?");
$stmt->bind_param("i",$f_id);
$stmt->bind_result($id,$name,$gstin ,$address,$fssai,$mobile,$bank_name,$account_number,$ifsc,$bank_address,$logo,$signature_image,$email,$state,$state_code);
$stmt->execute();
while($stmt->fetch()){
    array_push($firm_s,['id' =>$id, 'name' =>$name,'gstin' => $gstin,'address' =>$address,'fssai' => $fssai,'mobile' =>$mobile,'bank_name' =>$bank_name,'account_number'=>$account_number,'ifsc'=>$ifsc,'bank_address'=>$bank_address,'logo'=>$logo,'signature_image'=>$signature_image,'email'=>$email,'state'=>$state,'state_code'=>$state_code]);
}
$stmt->close();
$conn->close();
echo json_encode($firm_s);

?>