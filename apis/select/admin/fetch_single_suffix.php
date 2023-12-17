<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$suffix_id = $data['suffix_id'];
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT id,name FROM suffix WHERE id = ?");
$stmt->bind_param("i",$suffix_id);
$stmt->bind_result($id,$suffix);
$stmt->execute();
while($stmt->fetch()){
    array_push($users,['id' =>$id, 'suffix' =>$suffix]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>