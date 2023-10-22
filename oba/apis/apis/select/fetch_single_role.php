<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);
$role_id = $data['roleid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$users = [];
$stmt =$conn->prepare("SELECT * FROM roles WHERE id = ?");
$stmt->bind_param("i",$role_id);
$stmt->bind_result($id,$role);
$stmt->execute();
while($stmt->fetch()){
    array_push($users,['id' =>$id, 'role' =>$role]);
}
$stmt->close();
$conn->close();
echo json_encode($users);

?>