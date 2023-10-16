<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$username =$_POST["username"];
$pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
$phone =$_POST["mobile_number"];
$email= $_POST["email"];
$role =$_POST["role"];
$user_id =$_POST["U_id"];
$stmt = $conn->prepare("UPDATE user SET username = ?,password = ?,mobile_number = ?,email = ?, role = ? WHERE id = ?");
$stmt->bind_param("ssssii",$username,$pwd,$phone,$email,$role,$user_id);
$stmt->execute();
$user_id= $stmt->affected_rows;
$stmt->close();

$conn->close();

echo $user_id;
?>