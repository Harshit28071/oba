<?php
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
//header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$state_id =$data['removestateid'];
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();

$stmt = $conn->prepare("delete from `state` where id = ?");
$stmt->bind_param("i",$state_id);
$stmt->execute();
$id = $stmt->affected_rows;
$stmt->close();

$conn->close();
echo json_encode($id);
//echo $id;
?>