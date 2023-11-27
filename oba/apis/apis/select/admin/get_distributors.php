<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
//$state_id = $data['roleid'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();

$distributors = [];
$stmt = $conn->prepare("SELECT id,name,city FROM customer WHERE type='Distributor'");
//$stmt->bind_param("is",$cid);
$stmt->execute();
$stmt->bind_result($dis_id,$dis_name,$dis_city);
while($stmt->fetch()) {
    array_push($distributors,['id' =>$dis_id,'name' =>$dis_name,'city' => $dis_city]);
}
$stmt->close();



$conn->close();

echo json_encode($distributors);
?>