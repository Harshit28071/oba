<?php
include('../../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$state = $data['Addstate'];
$stmt = $conn->prepare("INSERT INTO `state`( `state`) VALUES (?)");
$stmt->bind_param("s",$state);
$stmt->execute();
$id = $stmt->insert_id;
$stmt->close();

$conn->close();

echo json_encode($id);
?>