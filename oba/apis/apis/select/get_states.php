<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
//$state_id = $data['roleid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();

$states = [];
$stmt = $conn->prepare("SELECT `id`, `state` FROM `state` ORDER BY state ASC;");
//$stmt->bind_param("is",$cid);
$stmt->execute();
$stmt->bind_result($id,$state);
while($stmt->fetch()) {
    array_push($states,['sid' =>$id,'statename' =>$state]);
}
$stmt->close();



$conn->close();

echo json_encode($states);
?>