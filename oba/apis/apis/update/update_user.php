<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$urlredirect ="../../pages/admin/user_login.php";
include("../../common/check_token.php");
header('Content-Type: application/json');
header('Access-Controle-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);
$u_id = $data['id'];
$username =$data["usernameedit"];
$pwd = password_hash($data["passwordedit"], PASSWORD_DEFAULT);
$phone =$data["mobile_numberedit"];
$email= $data["emailedit"];
$role =$data["roleedit"];
$stmt = $conn->prepare("UPDATE user SET username = ?,password = ?,mobile_number = ?,email = ?, role = ? WHERE id = ?");
$stmt->bind_param("ssssii",$username,$pwd,$phone,$email,$role,$u_id);
$stmt->execute();
$user_id= $stmt->affected_rows;
$stmt->close();

$conn->close();
echo json_encode($user_id);
//echo $user_id;
?>