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
$rid =$data["id_remove_user"];
$stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i",$rid);
$stmt->execute();
$rid = $stmt->affected_rows;
$stmt->close();

$conn->close();

echo json_encode($rid);
?>