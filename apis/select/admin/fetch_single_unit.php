<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$unit_id = $data['unitid'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$unitsarr = [];
$stmt =$conn->prepare("SELECT id,name FROM units WHERE id = ?");
$stmt->bind_param("i",$unit_id);
$stmt->bind_result($id,$unit);
$stmt->execute();
while($stmt->fetch()){
    array_push($unitsarr,['uid' =>$id, 'unitname' =>$unit]);
}
$stmt->close();
$conn->close();
echo json_encode($unitsarr);

?>