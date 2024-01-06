<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$state_id = $data['stateid'];
include($_SERVER['DOCUMENT_ROOT'].'/new/oba/common/database.php');
$db = new Database();
$conn = $db->connect();
$states = [];
$stmt =$conn->prepare("SELECT id,state FROM state WHERE id = ?");
$stmt->bind_param("i",$state_id);
$stmt->bind_result($id,$state);
$stmt->execute();
while($stmt->fetch()){
    array_push($states,['sid' =>$id, 'statename' =>$state]);
}
$stmt->close();
$conn->close();
echo json_encode($states);

?>