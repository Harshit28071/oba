<?php
include('../../common/database.php');
$db = new Database();
$conn = $db->connect();
$rid =$_POST["id"];
$stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i",$rid);
$stmt->execute();
$rid = $stmt->affected_rows;
$stmt->close();

$conn->close();

echo $rid;
?>