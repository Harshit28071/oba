<?php
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$details = [];
session_start();
if($_SESSION["s_role"] == "Accountant"){
$invoiceId = $_POST["id"];

$stmt =$conn->prepare("select i.date,i.amount,i.tax_type,f.name as firm_name,f.gstin as mygstin,f.address as myaddress,f.fssai,f.mobile,f.bank_name,f.account_number,f.ifsc,f.bank_address,f.logo,f.email,f.state,f.state_code,a.name,a.mobile_number,a.address,a.GSTIN,b.name as city,c.state,c.state_code FROM `gst_invoice` i  
left join customer a on i.party_id = a.id 
left join city b on a.city = b.id 
left join state c on a.state_id = c.id 
left join firm f on i.firm_id = f.id
where i.invoice_number = ?");
$stmt->bind_param("s",$invoiceId);
$stmt->execute();
$stmt->bind_result($date,$amount,$tax_type,$firm_name,$mygstin,$myaddress,$fssai,$mymobile,$bank_name,$account_number,$ifsc,$bank_address,$logo,$email,$mystate,$mystatecode,$name,$mobile,$address,$gstin,$city,$state,$code);

while($stmt->fetch()){
    array_push($details,['date' =>$date, 'amount' =>$amount,"tax_type"=>$tax_type,"firm_name"=>$firm_name,"mygstin"=>$mygstin,"myaddress"=>$myaddress,"fssai"=>$fssai,"mymobile"=>$mymobile,"bank_name"=>$bank_name,"account_number"=>$account_number,"ifsc"=>$ifsc,"bank_address"=>$bank_address,"logo"=>$logo,"email"=>$email,"mystate"=>$mystate,"mystatecode"=>$mystatecode,'name' => $name,'mobile' =>$mobile,'address' =>$address,'gstin'=>$gstin,'city'=>$city,'state'=>$state,'statecode'=>$code]);
}
$stmt->close();
$conn->close();
}
echo json_encode($details);

?>