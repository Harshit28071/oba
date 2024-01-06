<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"),true);
//$state_id = $data['roleid'];
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$distributor = [];
$stmt =$conn->prepare("SELECT a.distributor_id,b.name FROM customer a LEFT JOIN customer b ON a.id = b.distributor_id WHERE a.type ='Distributor'");
$stmt->execute();
$stmt->bind_result($distributor_id,$distributor_name);

while($stmt->fetch()){
    array_push($distributor,['did' =>$distributor_id, 'dname' =>$distributor_name]);
}
$stmt->close();
$conn->close();
echo json_encode($distributor);
?>