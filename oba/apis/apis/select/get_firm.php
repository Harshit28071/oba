<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$firm = [];
$stmt =$conn->prepare("SELECT id,name,gstin,address,fssai,mobile,bank_name,account_number,ifsc,bank_address,logo,signature_image,email,state,state_code FROM firm ORDER BY name ASC;");
$stmt->execute();
$stmt->bind_result($id,$name,$gstin ,$address,$fssai,$mobile,$bank_name,$account_number,$ifsc,$bank_address,$logo,$signature_image,$email,$state,$state_code);

while($stmt->fetch()){
    array_push($firm,['id' =>$id, 'name' =>$name,'gstin' => $gstin,'address' =>$address,'fssai' => $fssai,'mobile' =>$mobile,'bank_name' =>$bank_name,'account_number'=>$account_number,'ifsc'=>$ifsc,'bank_address'=>$bank_address,'logo'=>$logo,'signature_image'=>$signature_image,'email'=>$email,'state'=>$state,'state_code'=>$state_code]);
}
$stmt->close();
$conn->close();
echo json_encode($firm);

?>